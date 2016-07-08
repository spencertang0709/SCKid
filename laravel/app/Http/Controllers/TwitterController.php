<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TwitterController extends Controller
{
    public function index(Request $request)
    {
        return view('twitter',['me'=> $request->all()]);
    }
}
