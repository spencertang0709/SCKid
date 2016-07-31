<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TumblrController extends Controller
{
    public function index(Request $request)
    {
        return view('tumblr',['me'=> $request->all()]);
    }
}
