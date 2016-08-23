<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LogOut extends Controller
{
    public function index(Request $request) {
        $request->session()->forget('current_kid');
        $request->session()->forget('current_kid_name');
		echo 'success';
    }
}
