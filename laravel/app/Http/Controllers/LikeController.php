<?php

namespace App\Http\Controllers;
use App\Kid;
use App\LikedPage;
use Illuminate\Http\Request;
use App;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;


class LikeController extends Controller
{
     /**
     * Show a list of all likeed pages on child's facebook account
     *
     * @return Response
     */
    public function index()
    {
        $likes = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $kid = $currentKid->socialMedias()->get()->first();
            if($kid!=NULL) {
                $likes = $kid->likedPages()->get();
            }
        }
        return view('likes', ['likes' => $likes]);
    }
}
