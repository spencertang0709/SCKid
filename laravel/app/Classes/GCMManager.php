<?php

namespace App\Classes;

use App\Classes\Message;
use App\Classes\ReceivedMessage;
use App\Classes\NonRecipientException;
use App\Classes\TooManyRecipientsException;
use Nette\Object;
use Nette\Utils\Json;
use Jaxl;

class GCMManager extends Object {

    //Setup GCM server and port;
    const HOST = "gcm.googleapis.com";
    const PORT = "5235";
    const TEST_HOST = 'gcm-preprod.googleapis.com';
    const TEST_PORT = '5236';

    protected $client;

    public $onReady = [];
    public $onAuthFailure = [];
    public $onMessage = [];
    public $onAllSent = [];
    public $onSentSuccess = [];
    public $onSentError = [];
    public $onStop = [];
    public $onDisconnect = [];

    const ERROR_BAD_ACK = 'BAD_ACK';
    const ERROR_CONNECTION_DRAINING = 'CONNECTION_DRAINING';
    const ERROR_BAD_REGISTRATION = 'BAD_REGISTRATION';
    const ERROR_DEVICE_UNREGISTERED = 'DEVICE_UNREGISTERED';
    const ERROR_INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
    const ERROR_INVALID_JSON = 'INVALID_JSON';
    const ERROR_DEVICE_MESSAGE_RATE_EXCEEDED = 'DEVICE_MESSAGE_RATE_EXCEEDED';
    const ERROR_SERVICE_UNAVAILABLE = 'SERVICE_UNAVAILABLE';
    const ERROR_QUOTA_EXCEEDED = 'QUOTA_EXCEEDED';

    protected $messagesSent = 0;
    protected $messagesAcked = 0;

    public function __construct($senderId, $apiKey, $isTestMode)
    {
        $this->client = new JAXL(array(
            'jid' => "$senderId@gcm.googleapis.com",
            'pass' => $apiKey,
            'auth_type' => 'PLAIN',
            'host' => self::HOST,//$isTestMode ? self::TEST_HOST : self::HOST,
            'port' => self::PORT,//$isTestMode ? self::TEST_PORT : self::PORT,
            'strict' => false,
            'ssl' => true,
            'force_tls' => true,
            'log_level' => JAXL_DEBUG,
            'log_path' => 'GCMManagerLog.txt'
        ));

        $this->client->add_cb('on_auth_success', function () {
            //echo "successfully authorised";
            $this->onReady($this);
        });

        $this->client->add_cb('on_auth_failure', function ($reason) {
            //echo "authorisation failed";
            $this->onAuthFailure($this, $reason);
            $this->stop();
        });

        $this->client->add_cb('on_disconnect', function () {
            echo 'disconnect<br>';
            var_dump($this->client);
            //$this->onDisconnect($this);
        });

        $this->client->add_cb("on_normal_message", function ($stanza) {
            $data = $this->getDataFromStanza($stanza);
            $message = new ReceivedMessage(
                                @$data['category'],
                                @$data['data'],
                                @$data['time_to_live'],
                                @$data['message_id'],
                                @$data['from']);
            $this->sendAck($message);
            //echo "message sent";
            $this->onMessage($this, $message);
        });

        $this->client->add_cb("on_message", function ($stanza) {
            $data = $this->getDataFromStanza($stanza);
            $messageType = $data['message_type'];
            $messageId = $data['message_id']; //message id which was sent by us
            $from = $data['from']; //gcm key;
            if ($messageType == 'nack') {
                $errorDescription = @$data['error_description']; //usually empty ...
                $error = $data['error'];
                //echo "message sent";
                $this->onSentError($this, $from, $messageId, $error, $errorDescription);
            } else {
                $this->messagesAcked++;
                //echo "successfully sent";
                $this->onSentSuccess($this, $from, $messageId, $this->messagesAcked, $this->messagesSent);
                if ($this->messagesSent == $this->messagesAcked) {
                    //echo "all message sent";
                    $this->onAllSent($this, $this->messagesSent);
                }
            }
        });
    }

        /**
         * Methods that control the class instance
         */
        public function run() {
            $this->client->start();
        }

        public function stop() {
            //echo "stopped";
            $this->onStop($this);
            $this->client->send_end_stream();
        }

        public function send(Message $message) {
            if (count($message->getTo()) == 0) {
                throw new NonRecipientException("Recipient must set use");
            }
            if (count($message->getTo()) > 1) {
                throw new TooManyRecipientsException("Recipient must by only one");
            }
            $this->sendGCMMessage([
                'to' => $message->getTo(true),
                'collapse_key' => $message->getCollapseKey(), // Could be unset
                'time_to_live' => $message->getTimeToLive(), //Could be unset
                'delay_while_idle' => $message->getDelayWhileIdle(), //Could be unset
                'message_id' => (string) microtime(),
                'data' => $message->getData(),
            ]);
        }

        protected function sendAck(ReceivedMessage $message) {
           $this->sendGCMMessage([
                'to' => $message->getFrom(),
                'message_type' => 'ack',
                'message_id' => $message->getMessageId(),
            ]);
        }

        protected function sendGCMMessage($payload) {
            $message = '<message id=""><gcm xmlns="google:mobile:data">'
                            .Json::encode($payload).
                            '</gcm></message>';
            $this->client->send_raw($message);
        }

        public function getXMPPClient() {
            return $this->client;
        }

        protected function getDataFromStanza(\XMPPStanza $stanza) {
            $data = Json::decode(html_entity_decode($stanza->childrens[0]->text), Json::FORCE_ARRAY);
            return $data;
        }

}