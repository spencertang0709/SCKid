<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class GCMController extends Controller
{

    public function index(Request $request)
    {
        $gcmKey = DB::table('gcm_keys')
                    ->first();

		// API access key from Google API's Console
		define('API_ACCESS_KEY', $gcmKey->api_key);//'AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE');
		
		$registrationIds = $gcmKey->registration_token;
		
		//prep the bundle
		$msg = array
		(
			'message' => 'here is a message. message',
			'title'	=> 'This is a title. title',
			'subtitle' => 'This is a subtitle. subtitle',
			'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
			'vibrate' => 1,
			'sound'	=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> 'small_icon'
		);
		
		$fields = array
		(
			'registration_ids' => array($registrationIds),
			'data' => array("message" => $msg)
		);
		 
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
			//TODO encryption?
		);
		 
		$connection = curl_init();
		curl_setopt($connection, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt($connection, CURLOPT_POST, true);
		curl_setopt($connection, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($connection, CURLOPT_POSTFIELDS, json_encode($fields));
		
		$result = curl_exec($connection);
		curl_close($connection);
		
		echo $result;
	}
}
