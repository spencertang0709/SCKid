<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use DB;
use App;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
	$deviceID = $request->input('unique_id');
	$deviceID = 1234;
	
	$devices = DB::table('devices')->where('unique_id', '=', $deviceID)->get(); 
	foreach ($devices as $currentDevice) {
		//Convert collection array to model
		$currentKid = App\Kid::find($currentDevice->kid_id);
	}
	
	$contextPolicies = $currentKid->contextPolicies()->get();
	foreach ($contextPolicies as $contextPolicy) {
		echo "starttime:".$contextPolicy->start_time;
		$beacons = DB::table('beacons')->where('id', '=', $contextPolicy->id)->get();
		foreach ($beacons as $currentBeacon) {
			echo "beaconlocation:".$currentBeacon->location;	
		}
	}
	
   	/*
    return Response::json(
        array(
            'kid' => $currentKid->id,
		)
    );
	 */
}
