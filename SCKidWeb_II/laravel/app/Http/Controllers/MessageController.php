<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = $request->user()->messages()->get();
        return view('messages',['messages'=> $messages]);
    }
}
