<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App;
use App\Device;
use App\Message;
use App\Kid;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\GCMManager;
use App\Classes\ReceivedMessage;

class GCMUpstreamListener extends Controller
{
    const SENDER_ID = "219888626249";//"253574901081";//"e2G0JEsUxnU:APA91bGC5PgoSMKznTtdutQkiTUDNg7vjsEHELgMGoi07asFIHWMJ7ONpXnY3465o7gY6sZPzEwIrLmvHGS3CNoYy1wKq6xA7yB-XvOZ7OawnAUWMW9eWWxYrsWzuf5Gtm3n2EknUazR";
    const API_KEY = "AIzaSyD8hGzuCCaWcHmGdzlI2G4Hdo84iQWgB_o";//"AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE";//

    public function index(Request $request) {
        set_time_limit(0);
        global $messageManager;
        $messageManager = new GCMManager(self::SENDER_ID, self::API_KEY, false);
        global $counter;
        $counter = 0;

        global $messages;
        $messages = array();

        $messageManager->onReady[] = function(GCMManager $currentManager) {
            //echo "Ready / Auth success. Waiting for Messages";
        };

        $messageManager->onAuthFailure[] = function(GCMManager $currentManager, $reason) {
            //echo "Auth failure (reason $reason)";
        };

        $messageManager->onStop[] = function(GCMManager $currentManager) {
            //echo "Manager is stopped";
        };

        $messageManager->onDisconnect[] = function(GCMManager $currentManager) {
            //echo "Manager has been disconnected";
        };

        $messageManager->onMessage[] = function(GCMManager $currentManager, ReceivedMessage $message) {
//            echo "Received message from GCM";
//            var_dump($message);
//            global $messageManager;
//            $messageManager->stop();
             $payload = $message->getData();
             $payload = (array) $payload;

              //"IMEI" "title" "content"
            global $messages;
            array_push($messages,
                ['IMEI' => $payload['IMEI'],
                    'title' => $payload['title'],
                    'content' => $payload['content']
                ]
            );
//
//
//
            //  $device = App\Device::where('unique_id', $payload['IMEI'])->first();
             //
             $device = App\Device::where('unique_id', '8fc67a5d-0b8e-39b3-a9ca-21f903c9d2fd')->first();
             $GcmMessage = new App\GcmMessage();
             $GcmMessage->title = $payload['title'];
             $GcmMessage->content = $payload['content'];
             $GcmMessage->device()->associate($device);
             $GcmMessage->save();

            global $counter;
            $counter++;
            if ($counter>=3) {
                global $messageManager;
                $messageManager->stop();
                global $messages;
                echo json_encode($messages);
            }
        };

        $messageManager->run();
    }
}
