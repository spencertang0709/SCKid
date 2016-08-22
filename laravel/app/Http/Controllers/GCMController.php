<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class GCMController extends Controller
{

    public function index(Request $request)
    {
		// API access key from Google API's Console
		define('API_ACCESS_KEY', 'AIzaSyD8hGzuCCaWcHmGdzlI2G4Hdo84iQWgB_o');//'AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE');
		
		$registrationIds = "e2G0JEsUxnU:APA91bGC5PgoSMKznTtdutQkiTUDNg7vjsEHELgMGoi07asFIHWMJ7ONpXnY3465o7gY6sZPzEwIrLmvHGS3CNoYy1wKq6xA7yB-XvOZ7OawnAUWMW9eWWxYrsWzuf5Gtm3n2EknUazR";
		
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
