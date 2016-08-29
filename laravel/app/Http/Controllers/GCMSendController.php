<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Device;
use App\VerificationCode;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class GCMSendController extends Controller
{
    public function index(Request $request)
    {
		//Get all the devices that a user owns
        $devices = $request->user()->devices()->get();

		//Get the device that is linked to the current kid
		$kidID = Session::get('current_kid');
		$currentKid = App\Kid::find($kidID);

        //Kids will be accessible in our home view
        if ($currentKid == NULL) {
        	return view('GCMsend', [
        		'devices' => $devices,
                'kids' => $currentKid
        	]);
        } else {
        	$currentDevice = $currentKid->devices()->get();
        	return view('GCMsend', [
        		'devices' => $currentDevice,
                'kids' => $currentKid
        	]);
        }
    }

    public function send(Request $request, Device $device)
    {
        //Validate our parameters
        $this->validate($request, [
            'GCMTitle' => 'required|max:255',
            'GCMMessage' => 'required|max:255',
        ]);

        $gcmKey = DB::table('gcm_keys')->where('device_id',$device->id)->first();

        if($gcmKey==null){
            return redirect('/GCM')->with('GCMmsg','Please register GCM key!');
        }

		// API access key from Google API's Console
		define('API_ACCESS_KEY', $gcmKey->api_key);//'AIzaSyD-NwwakxSb9czyuRycV6reTBjq0OJqhKE');

		$registrationIds = $gcmKey->registration_token;

		//prep the bundle
		$msg = array
		(
            'title' => $request['GCMTitle'],
            'message' => $request['GCMMessage'],
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

		return redirect('/GCM');
    }
}
