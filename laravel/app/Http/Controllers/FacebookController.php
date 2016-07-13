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
            $fb = $currentKid->socialMedias()->get()->first();

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
            $currentKid->socialMedias()->detach();
            $currentKid->socialMedias()->delete();
        }
        //return view('facebook',['me'=> $request->all()]);
        return view('facebook',['fb'=> $fb]);

    }
}
