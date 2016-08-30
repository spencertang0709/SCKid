<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CurrentKidController extends Controller
{
    public function select(Request $request) {
    	Session::put('current_kid', $request->id);
		Session::put('current_kid_name', $request->name);
		Session::put('kid_text', 'Current Child is:');
		Session::put('startPickTime', $request->startPickTime);
        Session::put('endPickTime', $request->endPickTime);
		echo $request->name;
    }

    public function getCurrentKid(Request $request) {
        $kidId = Session::get('current_kid');
        echo $kidId;
    }
}
