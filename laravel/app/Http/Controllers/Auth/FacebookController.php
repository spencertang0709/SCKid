<?php

namespace App\Http\Controllers\Auth;

use App\Kid;
use App\SocialMedia;
use Facebook\Facebook;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


//http://goodheads.io/2015/08/24/using-facebook-authentication-for-login-in-laravel-5/
class FacebookController extends Controller
{

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        //If current kid has facebook
        
        return Socialite::driver('facebook')->redirect();

        //This is where we can add permissions for the app
        //return Socialite::driver('facebook')->scopes(['scope1','scope2'])->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $me = Socialite::driver('facebook')->user();

        //Retrieving Details
        // OAuth Two Providers
        $token = $me->token;
        
        //Saving Token here
        $kidID = Session::get('current_kid');
        $fb_profile = Socialmedia::create([$kidID]);

        $currentKid = Kid::find($kidID);
        if ($currentKid != NULL) {
            $currentKid->socialMedias()->save($fb_profile,['token' => $token]);
        }

        // All Providers
        $me->getId();
        $me->getNickname();
        $me->getName();
        $me->getEmail();
        $me->getAvatar();
        
        //Get timeline then send to view
        $fb = new Facebook();
        $response = $fb->get('/me/',$token);
        $user = $response->getGraphUser();

        return view('/facebook',['me' => $me]);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        return User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            'avatar' => $facebookUser->avatar
        ]);
    }
}
