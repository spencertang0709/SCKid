<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use DB;
use App;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PolicyController extends Controller
{	 
	public function index(Request $request)
    {
		//$deviceId = $request->input('unique_id');
		$deviceId = 1234;
		
		//Get related data from input
		$currentDevice = DB::table('devices')
							->where('unique_id', '=', $deviceId)
							->first();
		$currentKid = App\Kid::find($currentDevice->kid_id);
		 
		$index = 0;
		$outputArray[$index] = array();
		
		$contextPolicies = $currentKid->contextPolicies()
							->select('id', 'start_time as startTime', 'end_time as endTime', 'app_list as appList', 'screen_time as screenTime')
							->get();
		foreach ($contextPolicies as $contextPolicy) {
			//Cast to array to fetch the data needed
			$policyObjectArray = (array)$contextPolicy;
			$policyObjectArrayKeys = array_keys($policyObjectArray);
			$dataAttributeString = 'attributes';
			foreach ($policyObjectArrayKeys as $key) {
				//Go around the protected attribute name in the original object
				if (ord($key) == 0) {
					$keyName = substr($key, 3);
				} else {
					$keyName = $key;
				}
				
				//Record target data in the original object
				if (strcmp($keyName, $dataAttributeString) == 0) {
					$policyArray = $policyObjectArray[$key];
					$policyArrayKeys = array_keys($policyArray);
				}	
			}
			
			//Get location from related beacon
			$beaconLocation = DB::table('beacons')->where('id', '=', $contextPolicy->id)->value('location');
			
			//Reformat the data according to requirements
			$formatArray = array(
				'beaconLocation' => $beaconLocation,
			);
			unset($policyArray[$policyArrayKeys[0]]);
			$policyArrayKeys = array_keys($policyArray);
			
			foreach ($policyArrayKeys as $key) {
				$formatArray[$key] = $policyArray[$key];	
			}
			
			//Add to output array for JSON conversion
			$outputArray[$index] = $formatArray;
			$index++;
			
		}
		
	    return Response::json(
	        array(
	            "kidId" => $currentKid->id,
				"caPolicy" => $outputArray
			)
	    );
	}		 
}
