<?php

namespace App\Http\Controllers;

use App\Kid;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
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

        //Todo adding authorisation for the user that owns the current kid
//        $this->middleware('user_owns');
    }


    /**
     * Display a list of all of the kids's calls
     *
     * @param  Request  $request
     */
    public function index(Request $request)
    {
    	$smss = NULL;
		
        $kidID = Session::get('current_kid');
        $currentKid = Kid::find($kidID);
		if ($currentKid != NULL) {
			$smss = $currentKid->smss()->get();	
		}

        return view('sms', ['smss' => $smss,]);
    }
}
