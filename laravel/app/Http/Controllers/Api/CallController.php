<?php

namespace App\Http\Controllers\Api;

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
        $kid = $request->input('kid.id');
        $calls = DB::table('calls')->where('kid_id', '=', $kid)->get();

        return Response::json(
            array(
                'method' => 'index',
                'error' => false,
                'status' => '200',
                'calls' => $calls)
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
        $id = $request->input('kid.id');
        $calls = $request->input('kid.calls');

        $kid = Kid::find($id);
        $kid->calls()->createMany($calls);

        return Response::json(
            array(
                'kid' => $kid,
                'calls' => $calls,
                'status' => 'Success Added Calls!')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kid = Kid::find($id);
        return $kid->calls()->get();
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
