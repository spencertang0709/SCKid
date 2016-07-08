<?php

namespace App\Http\Controllers;
use App\Kid;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class CallController extends Controller
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

    
    /**
     * Display a list of all of the kids's calls
     *
     * @param  Request  $request
     */
    public function index(Request $request)
    {
    	$calls = NULL;
		
        //Get our current kid and get the calls for that kid
		$kidID = Session::get('current_kid');
        $currentKid = Kid::find($kidID);		
		if ($currentKid != NULL) {
			$calls = $currentKid->calls()->get();
		} 
		
		return view('calls', ['calls' => $calls]);
        
    }
}
