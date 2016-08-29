<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Kid;
use App\Device;
use App\VerificationCode;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Session;
use DB;


class VerificationCodeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        //Check if code matches
        $inputCode = $request->input('verificationCode');
        $resultCode = VerificationCode::where('value', $inputCode)->first();

        if ($resultCode != null)
        {
            //Check if the code has expired
            $timeLimit = 60;
            $initialTime = $resultCode->created_at;
            $secsElapsed = strtotime(date("Y-m-d h:i:sa")) - strtotime($initialTime->toDateTimeString());
            if ($secsElapsed <= $timeLimit) {
                $user = $resultCode->user()->first();
                echo "User verified";

                $currentDevice = DB::table('devices')
                                    ->where('unique_id', '=', $request['IMEI'])
                                    ->first();
                if ($currentDevice == null) {
                    $device = new Device();
                    $device->name = $request['name'];
                    $device->model = $request['model'];
                    $device->unique_id = $request['IMEI'];
                    $device->save();

                    $device->users()->attach($user->id);
                    echo "Device registered";
                } else {
                    echo "Device already registered";
                }


            } else {
                echo "Verification code has expired ".$timeLimit.' secs';
            }
        } else{
            echo "Verification code is incorrect"
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store()
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    //  public function show($userId, $inputCode)
    //  {
    //      //TODO authorisations
    //      $resultCode = VerificationCode::find($inputCode);
    //      $user = $resultCode->user()->get();
    //      if($user->id==$userId)
    //      {
    //          return Response::json(
    //          array(
    //              'error' => false,
    //              'status' => '200',
    //              'user' => $user,
    //              'code' => $resultCode)
    //          );
    //      }
    //  }

    public function show(Request $request)
    {

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
