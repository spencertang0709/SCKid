<?php

namespace App\Http\Controllers\Api;

use App\Kid;
use App\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class SyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Get clients last update time from server
        $time = $request->input("last_update");


        //$user = JWTAuth::parseToken()->authenticate();

        //Get last updated row from Website
        //return DB::table('files')->orderBy('upload_time', 'desc')->first();

        $last_created_kids = Kid::orderBy('created_at', 'desc')->first();
        $last_updated_kids = Kid::orderBy('updated_at', 'desc')->first();

        //Using Carbon to manage dates
//        $carbon = Kid::where('created_at', '<=', Carbon::now()->startOfYear())->get();

        $carbon = Kid::where('created_at', '<', $time)->get();

        return Response::json(
            array(
//                'last_created_kids' => $last_created_kids,
//                'last_updated_kids' => $last_updated_kids,
                'carbon' => $carbon
            )
        );
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
