<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\VerificationCode;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class VerificationCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
    //  public function show($userId, $verifCode)
    //  {
    //      //TODO authorisations
    //      $code = VerificationCode::find($verifCode);
    //      $user = $code->user()->get();
    //      if($user->id==$userId)
    //      {
    //          return Response::json(
    //          array(
    //              'error' => false,
    //              'status' => '200',
    //              'user' => $user,
    //              'code' => $code)
    //          );
    //      }
    //  }

     public function show($verifCode)
     {
         //TODO authorisations
        $code = VerificationCode::where('value',$verifCode)->first();

        if($code!=null)
          {
            $user = $code->user()->get();
            return Response::json(
                array(
                    'error' => false,
                    'status' => '200',
                    'say' => 'howddy',
                    'code' => $code,
                    'user' =>$user
                ));
         }
         else{
              return Response::json(
                  array(
                      'error' => true,
                      'status' => '400'
                  ));
         }
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
