<?php

namespace App\Http\Controllers;
use App\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class TimeController extends Controller
{
    public function index()
    {
        $monday = DB::table('times')->where('day','Monday')->first();
        $tuesday = DB::table('times')->where('day','Tuesday')->first();
        $wednesday = DB::table('times')->where('day','Wednesday')->first();
        $thursday = DB::table('times')->where('day','Thursday')->first();
        $friday = DB::table('times')->where('day','Friday')->first();
        $saturday = DB::table('times')->where('day','Saturday')->first();
        $sunday = DB::table('times')->where('day','Sunday')->first();

        return view('time', ['monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 'thursday' => $thursday, 'friday' => $friday, 'saturday' => $saturday, 'sunday' => $sunday,]);
    }


    /**
     * CUpdate times
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::table('times')
            ->where('day','Monday')
            ->update(['start_time' => $request->monday1, 'end_time'=>$request->monday2,]);
        DB::table('times')
            ->where('day','Tuesday')
            ->update(['start_time' => $request->tuesday1, 'end_time'=>$request->tuesday2,]);
        DB::table('times')
            ->where('day','Wednesday')
            ->update(['start_time' => $request->wednesday1, 'end_time'=>$request->wednesday2,]);
        DB::table('times')
            ->where('day','Thursday')
            ->update(['start_time' => $request->thursday1, 'end_time'=>$request->thursday2,]);
        DB::table('times')
            ->where('day','Friday')
            ->update(['start_time' => $request->friday1, 'end_time'=>$request->friday2,]);
        DB::table('times')
            ->where('day','Saturday')
            ->update(['start_time' => $request->saturday1, 'end_time'=>$request->saturday2,]);
        DB::table('times')
            ->where('day','Sunday')
            ->update(['start_time' => $request->sunday1, 'end_time'=>$request->sunday2,]);

        return redirect('/time');
    }
}
