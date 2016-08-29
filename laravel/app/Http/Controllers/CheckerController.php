<?php

namespace App\Http\Controllers;
use App\Kid;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class CheckerController extends Controller
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
        $words = DB::table('sensitive_words')->pluck('keyword');
        return view('sensitive_checker', ['posts' => $posts,'words' => $words]);
    }
}
