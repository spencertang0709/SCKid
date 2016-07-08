<?php

namespace App\Http\Controllers;
use App\Kid;
use App\Like;
use Illuminate\Http\Request;

use App\Http\Requests;

class LikeController extends Controller
{
     /**
     * Show a list of all likeed pages on child's facebook account
     *
     * @return Response
     */
    public function index()
    {
        $likes = Like::all();
        return view('likes', ['likes' => $likes]);
    }
}
