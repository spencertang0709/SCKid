<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use DB;

class GCMKeyController extends Controller
{
    public function index(Request $request) {
        //Get device related data from mobile
        $deviceId = DB::table('devices')
                        ->where('unique_id', '=', $request->input('IMEI'))
                        ->value('id');
        $currentDevice = App\Device::find($deviceId);
        if ($currentDevice == null) {
            echo "Please register first";
            return Response::json (
                array(
                    'response' => 'deviceNotRegistered'
                    //TODO send a prompt message on mobile to ask user to register
                ));
        }

        //Store device related GCM data
        $apiKey = $request->input('apiKey');
        $registrationToken = $request->input('registrationToken');
        $currentGcmKeys = new App\GcmKey();
        $currentGcmKeys->api_key = $apiKey;
        $currentGcmKeys->registration_token = $registrationToken;
        $currentGcmKeys->device_id = $currentDevice->id;
        $currentGcmKeys->save();

        echo "GCM keys saved!";
    }

    public function store(Request $request) {
        //Get device related data from mobile
        $deviceId = DB::table('devices')
            ->where('unique_id', '=', $request->input('IMEI'))
            ->value('id');
        $currentDevice = App\Device::find($deviceId);
        if ($currentDevice == null) {
            echo "Please register first";
            return Response::json (
                array(
                    'response' => 'deviceNotRegistered'
                    //TODO send a prompt message on mobile to ask user to register
                ));
        }

        //Store device related GCM data
        $apiKey = $request->input('apiKey');
        $registrationToken = $request->input('registrationToken');
        $currentGcmKeys = new App\GcmKey();
        $currentGcmKeys->api_key = $apiKey;
        $currentGcmKeys->registration_token = $registrationToken;
        $currentGcmKeys->device_id = $currentDevice->id;
        $currentGcmKeys->save();

        echo "GCM keys saved!";
    }

}
