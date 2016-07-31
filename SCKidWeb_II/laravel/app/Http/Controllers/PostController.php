<?php

namespace App\Http\Controllers;
use App\Kid;
use App\Post;
use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
     /**
     * Show a list of all posts on child's facebook account
     *
     * @return Response
     */
    public function index()
    {
        $posts = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $kid = $currentKid->socialMedias()->get()->first();
            if($kid!=NULL) {
                $posts = $kid->posts()->get();
            }
        }
        return view('posts', ['posts' => $posts]);
    }
}
