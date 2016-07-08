<?php

namespace App\Http\Controllers\Auth;


use App\Kid;
use App\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $me = Socialite::driver('twitter')->user();
        $token = $me->token;
        $name = $me->getName();


        //Saving Token here
        $kidID = Session::get('current_kid');
        $profile = Socialmedia::create([$kidID]);

        $currentKid = Kid::find($kidID);
        if ($currentKid != NULL) {
            $currentKid->socialMedias()->save($profile,['token' => $token]);
        }

        return view('/twitter',['me' => $me]);
    }
}
