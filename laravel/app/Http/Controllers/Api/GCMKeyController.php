<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\GCMManager;
use App\Classes\ReceivedMessage;

class GCMKeyController extends Controller
{
    const SENDER_ID = "e2G0JEsUxnU:APA91bGC5PgoSMKznTtdutQkiTUDNg7vjsEHELgMGoi07asFIHWMJ7ONpXnY3465o7gY6sZPzEwIrLmvHGS3CNoYy1wKq6xA7yB-XvOZ7OawnAUWMW9eWWxYrsWzuf5Gtm3n2EknUazR";
    const API_KEY = "bcdAIzaSyD8hGzuCCaWcHmGdzlI2G4Hdo84iQWgB_o";

    public function index(Request $request) {
        $messageManager = new GCMManager(self::SENDER_ID, self::API_KEY, false);

        $messageManager->onReady[] = function(GCMManager $currentManager) {
            echo "Ready / Auth success. Waiting for Messages";
        };

        $messageManager->onAuthFailure[] = function(GCMManager $currentManager, $reason) {
            echo "Auth failure (reason $reason)";
        };

        $messageManager->onStop[] = function(GCMManager $currentManager) {
            echo "Manager is stopped";
        };

        $messageManager->onDisconnect[] = function(GCMManager $currentManager) {
            echo "Manager has been disconnected";
        };

        $messageManager->onMessage[] = function(GCMManager $currentManager, ReceivedMessage $message) {
            echo "Received message from GCM";
            var_dump($message);
        };

        $messageManager->run();

    }
}
