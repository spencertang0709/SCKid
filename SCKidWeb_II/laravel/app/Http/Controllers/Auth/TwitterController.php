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
        //var_dump($me);
        $xx = $me->user;
        //var_dump($me);
        $token = $me->token;
        $name = $me->name;
        $nickname = $me->nickname;
        $avatar = $me->avatar;


        //Saving Token here
        $kidID = Session::get('current_kid');
        $tw_profile = Socialmedia::create([$kidID]);

        $currentKid = Kid::find($kidID);
        if ($currentKid != NULL) {
            $currentKid->socialMedias()->save($tw_profile,['token' => $token,'nickname' => $nickname, 'name' => $name,'avatar' => $avatar,'social_media_type'=> "2" ]);
        }

        return view('/twitter',['me' => $me]);
    }
}
