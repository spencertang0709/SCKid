<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class GCMController extends Controller
{

    public function index(Request $request)
    {
		// API access key from Google API's Console
		define('API_ACCESS_KEY', 'AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE');
		
		$registrationIds = "cYLIzTmJ598:APA91bFyjjsr5TuGCmBP6CZ6bb2fYhwm21joPsvxmN50873Csjaqc36EB3qSgk63OKcbe3X-QRbf6j_zCpjHk79nuNwwE8B8mblUUTl3CxNBFaKgjK9nWig7PhVmFpYpLVcwFyxd8YoD";
		
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
