<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class TwitterController extends Controller
{
    public function index(Request $request)
    {
        $tw = NULL;
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $tw = $currentKid->socialMedias()->where('social_media_type', '2')->first();
        }
        return view('twitter',['tw'=> $tw]);
    }
    public function destroy(Request $request)
    {

        $tw = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $currentKid->socialMedias()->wherePivot('social_media_type', 2)->detach();
            $currentKid->socialMedias()->wherePivot('social_media_type', 2)->delete();
        }
        //return view('facebook',['me'=> $request->all()]);
        return view('twitter',['tw'=> $tw]);

    }
}
