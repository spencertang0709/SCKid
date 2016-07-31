<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Requires authentication
        $this->middleware('auth');
    }

    public function index()
    {
        $devices = DB::table('devices')->get();
        //Kids will be accessible in our home view
        return view('manage_device', ['devices' => $devices,]);
    }
    /**
     * Update mobile feature setting.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'cb' => 'required|max:1'
        ]);

        DB::table('devices')
            ->where('feature',$request->input('feature_name'))
            ->update(['action' => $request->cb, 'start_time'=>$request->start_time, 'end_time'=>$request->end_time]);
        return redirect('/manage_device');
    }
}
