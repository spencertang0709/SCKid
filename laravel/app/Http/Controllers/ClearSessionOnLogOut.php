<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClearSessionOnLogOut extends Controller
{
    public function index(Request $request) {
        $request->session()->forget('current_kid');
        $request->session()->forget('current_kid_name');
        $request->session()->forget('kid_text');
		echo 'success';
    }
}
