<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Device;

class GCMController extends Controller
{

    public function index(Request $request)
    {
        $gcmKey = DB::table('gcm_keys')
                    ->first();

		// API access key from Google API's Console
		define('API_ACCESS_KEY',$gcmKey->api_key);// 'AIzaSyD8hGzuCCaWcHmGdzlI2G4Hdo84iQWgB_o');
		
		$registrationIds = $gcmKey->registration_token;//"e2G0JEsUxnU:APA91bGC5PgoSMKznTtdutQkiTUDNg7vjsEHELgMGoi07asFIHWMJ7ONpXnY3465o7gY6sZPzEwIrLmvHGS3CNoYy1wKq6xA7yB-XvOZ7OawnAUWMW9eWWxYrsWzuf5Gtm3n2EknUazR";//

		//prep the bundle
		$msg = array
		(
		    'isData' => 'true',
			'command' => 'getSMS'
		);
        
		$fields = array
		(
			'registration_ids' => array($registrationIds),
            'priority' => 'high',
			'data' => (array) $msg
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
