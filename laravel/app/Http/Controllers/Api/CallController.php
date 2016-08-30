<?php

namespace App\Http\Controllers\Api;

use App;
use App\Call;
use App\Kid;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Mockery\CountValidator\Exception;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deviceId = $request->input('device.IMEI');

        try {
            $currentDevice = App\Device::findOrFail($deviceId);
        } catch (App\Classes\Exception $e) {
            return Response::json(
                array (
                    'response' => 'Device not found'
                )
            );
        }

        try {
            $currentKid = App\Kid::findOrFail($currentDevice->kid_id);
        } catch (App\Classes\Exception $e) {
            return Response::json(
                array (
                    'response' => 'Device not associated with a kid'
                )
            );
        }

        $calls = DB::table('calls')->where('kid_id', '=', $currentKid->id)->get();

        return Response::json(
            array (
//                'method' => 'index',
//                'error' => false,
//                'status' => '200',
                'calls' => $calls
            )
        );

        //return Call::paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *
     * //Send this as JSON POST to api/v1/calls
     *
     *
     * {
    "kid": {
    "id": "1",
    "calls": [
    {
    "number": "675-379-5469",
    "contact": "JSON",
    "direction": "0",
    "time": "1983-10-20 07:08:41"
    }
    ]
    }
    }
     *
     *
     *
     */
    public function store(Request $request)
    {
        //Dot syntax for digging deeper in array
        $deviceId = $request->input('device.IMEI');
        $calls = $request->input('device.calls');

        try {
            $currentDevice = App\Device::findOrFail($deviceId);
        } catch (App\Classes\Exception $e) {
            return Response::json(
                array (
                    'response' => 'Device not found'
                )
            );
        }

        try {
            $currentKid = App\Kid::findOrFail($currentDevice->kid_id);
        } catch (App\Classes\Exception $e) {
            return Response::json(
                array (
                    'response' => 'Device not associated with a kid'
                )
            );
        }

        $currentKid->calls()->createMany($calls);
        return Response::json(
            array (
                'response' => 'Success'
            )
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($deviceId)
    {
        $currentDevice = App\Device::find($deviceId);
        try {
            $currentKid = App\Kid::findOrFail($currentDevice->kid_id);
        } catch (App\Classes\Exception $e) {
            return Response::json(
                array (
                    'response' => 'Device not associated with a kid'
                )
            );
        }
        return $currentKid->calls()->get();
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
