<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InstagramController extends Controller
{
    public function index(Request $request)
    {
        return view('instagram',['me'=> $request->all()]);
    }
}
