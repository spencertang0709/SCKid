<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BeaconController extends Controller
{
    public function index(Request $request)
    {
		$deviceID = $request->input('IMEI');
		
		/*
		$currentDevice = DB::table('device')->where('id', '=', $deviceID)->get(); 
		$currentKid = $currentDevice->kid()->get();
		
		$beacons = $currentKid->beacons()->get();
		$contextPolicies = $currentKid->contextPolicies()->get(); 
        */

        return Response::json(
            array(
                'test' => $deviceID
			)
        );

    }
}
