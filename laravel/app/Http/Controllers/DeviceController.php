<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\VerificationCode;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class DeviceController extends Controller
{

    public function index(Request $request)
    {
        //TODO authorisation controls the device that they are wanting to edit
        // $this->authorize('owns', $request->user());

        // $devices = DB::table('devices')->get();

		//Get all the devices that a user owns
        $devices = $request->user()->devices()->get();

		//Get the device that is linked to the current kid
		$kidID = Session::get('current_kid');
		$currentKid = App\Kid::find($kidID);

        //Kids will be accessible in our home view
        if ($currentKid == NULL) {
        	return view('devices', [
        		'devices' => $devices,
                'kids' => $currentKid
        	]);
        } else {
        	$currentDevice = $currentKid->devices()->get();
        	return view('devices', [
        		'devices' => $currentDevice,
        		//'currentDevice' => $currentDevice
                'kids' => $currentKid
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
        //Generate verification code
        $code = rand(1, 1000000);//TODO better algorithm for encryption and avoid same value

        //Get current user associated with the current code and save it
        $user = $request->user();
        VerificationCode::where('user_id',$user->id)->delete();

        VerificationCode::create(array(
        	'value' => $code,
        	'user_id'=> $user->id
        ));

		echo $code;
    }

    public function destroy(Request $request, App\Device $device_id){
        $device_id->delete();
        return redirect('/devices');
    }
}
