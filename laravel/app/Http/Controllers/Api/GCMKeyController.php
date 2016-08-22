<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\GCMManager;
use App\Classes\ReceivedMessage;

class GCMKeyController extends Controller
{
    const SENDER_ID = "219888626249aaa";//"e2G0JEsUxnU:APA91bGC5PgoSMKznTtdutQkiTUDNg7vjsEHELgMGoi07asFIHWMJ7ONpXnY3465o7gY6sZPzEwIrLmvHGS3CNoYy1wKq6xA7yB-XvOZ7OawnAUWMW9eWWxYrsWzuf5Gtm3n2EknUazR";
    const API_KEY = "AIzaSyD8hGzuCCaWcHmGdzlI2G4Hdo84iQWgB_o";

    public function index(Request $request) {
        $messageManager = new GCMManager('SENDER_ID', 'API_KEY', false);

        $messageManager->onReady[] = function(GCMManager $currentManager) {
            print "Ready / Auth success. Waiting for Messages";
        };

        $messageManager->onAuthFailure[] = function(GCMManager $currentManager, $reason) {
            print "Auth failure (reason $reason)";
        };

        $messageManager->onStop[] = function(GCMManager $currentManager) {
            print "Manager is stopped";
        };

        $messageManager->onDisconnect[] = function(GCMManager $currentManager) {
            print "Manager has been disconnected";
        };

        $messageManager->onMessage[] = function(GCMManager $currentManager, ReceivedMessage $message) {
            print "Received message from GCM";
            print_r($message);
        };

        $messageManager->run();

    }
}
