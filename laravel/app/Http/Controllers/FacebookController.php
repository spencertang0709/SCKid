<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FacebookController extends Controller
{
    public function index(Request $request)
    {
        return view('facebook',['me'=> $request->all()]);
    }
}
