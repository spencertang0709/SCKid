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

        return view('devices', [
            'devices' => $devices,
            'kids' => $currentKid
        ]);

    }

    public function verifyCode(Request $request)
    {
        //Generate verification code
        $passphrase = $request['passphrase'];
        $code = rand(100000, 1000000);
        $code = $code.$passphrase;

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

    public function getKidAvailable(Request $request) {
        //Get selected device and prepare all registered device
        $selectedDevice = DB::table('devices')
                            ->where('id', '=', $request['deviceId'])
                            ->first();
        $registeredDevices = $request->user()->devices()->get();

        //Get all registered kids to filter out associated kids
        $registeredKids = $request->user()->kids()->get();
        $index = 0;
        $registeredKidIdArray[$index] = array();
        foreach ($registeredKids as $kid) {
            $registeredKidIdArray[$index] = $kid->id;
            $index++;
        }
        $kidIdArraylength = $index;

        //Start filtering out the kids with device
        $availableKidNames = [];
        $availableKidNames[-1] = "*Unregister Kid*";
        $kidId = $selectedDevice->kid_id;
        if ($kidId != NULL) {
            $availableKidNames[0] = $selectedDevice->kid_id;
            $availableKidNames[$selectedDevice->kid_id] = DB::table('kids')
                                            ->where('id', '=', $kidId)
                                            ->value('name');
        }

        foreach ($registeredDevices as $device) {
            if ($device->kid_id != NULL) {
                $unavailableKidId = array_search($device->kid_id, $registeredKidIdArray);
                $registeredKidIdArray[$unavailableKidId] = -1;
            }
        }

        //Add available kids to the response array
        for ($i = 0; $i < $kidIdArraylength; $i++) {
            $kidId = $registeredKidIdArray[$i];
            if ($kidId != -1) {
                $availableKidNames[$registeredKidIdArray[$i]] = DB::table('kids')
                                                ->where('id', '=', $kidId)
                                                ->value('name');
            }
        }

        echo json_encode($availableKidNames);
    }

    public function associateKidDevice(Request $request) {
        $deviceId = $request['deviceId'];
        $kidId = $request['kidId'];
        if ($kidId == -1) {
            $kidId = NULL;
        }

        DB::table('devices')
            ->where('id', $deviceId)
            ->update(['kid_id' => $kidId]);
    }

    public function changeDeviceName(Request $request) {
        $deviceId = $request['deviceId'];
        $deviceName = $request['deviceName'];

        DB::table('devices')
            ->where('id', $deviceId)
            ->update(['name' => $deviceName]);
    }
}
