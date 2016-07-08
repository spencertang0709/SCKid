<?php

namespace App\Http\Controllers;
use App\Kid;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
     /**
     * Show a list of all posts on child's facebook account
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts', ['posts' => $posts]);
    }
}
