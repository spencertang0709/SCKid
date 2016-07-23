<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class DeviceController extends Controller
{

    public function index(Request $request)
    {
        //TODO authorisation controls the device that they are wanting to edit
//        $this->authorize('owns', $request->user());

//        $devices = DB::table('devices')->get();

		//Get all the devices that a user owns
        $devices = $request->user()->devices()->get();

		//Get the device that is linked to the current kid
		$kidID = Session::get('current_kid');
		$currentKid = App\Kid::find($kidID);

        //Kids will be accessible in our home view
        if ($currentKid == NULL) {
        	return view('devices', [
        		'devices' => $devices
        	]);
        } else {
        	$currentDevice = $currentKid->devices()->get();
        	return view('devices', [
        		'devices' => $devices,
        		//'currentDevice' => $currentDevice
        	]);
        }

		/*
		foreach($currentDevice as $device) {//convert collection:$currentDevice to a model
			$devices->push($device);
		}
		*/
    }

    public function verifyCode(Request $request)
    {
        $user=$request->user();
        //generate verification code
        //$code=App\VerificationCode::where('id',$user->id)->first();
        //save code to database
        echo $code->value;
    }
}
