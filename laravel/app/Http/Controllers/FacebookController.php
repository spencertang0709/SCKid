<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class FacebookController extends Controller
{
    public function index(Request $request)
    {
        $fb = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $fb = $currentKid->socialMedias()->where('social_media_type', '1')->first();

        }
        //return view('facebook',['me'=> $request->all()]);
        return view('facebook',['fb'=> $fb]);

    }
    public function destroy(Request $request)
    {

        $fb = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $currentKid->socialMedias()->wherePivot('social_media_type', '1')->detach();
            $currentKid->socialMedias()->wherePivot('social_media_type', '1')->delete();
        }
        //return view('facebook',['me'=> $request->all()]);
        return view('facebook',['fb'=> $fb]);

    }
}
