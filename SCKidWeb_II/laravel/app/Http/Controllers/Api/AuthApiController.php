<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthApiController extends Controller
{

    //https://github.com/tymondesigns/jwt-auth/wiki/Creating-Tokens
    public function auth(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    [
                        'error' => 'invalid_credentials',
                    ], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function signup(Request $request){

        $credentials = $request->only('email', 'password','name');

        try {
            $user = User::create($credentials);
        } catch (Exception $e) {
            return Response::json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
        }

        $token = JWTAuth::fromUser($user);
        return Response::json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
//        return response()->json(compact('user'));

        return $user;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $url = new Url;
        $url->url = Request::get('url');
        $url->description = Request::get('description');
        $url->id = Auth::user()->id;

        // Validation and Filtering is sorely needed!!
        // Seriously, I'm a bad person for leaving that out.

        $url->save();

        return Response::json(array(
            'error' => false,
            'urls' => $urls->toArray()),
            200
        );
    }

    /**
     * Shows a resource from $id
     *
     * @return Response
     */
    public function show($id)
    {
        // Make sure current user owns the requested resource
        $url = Url::where('id', Auth::user()->id)
            ->where('id', $id)
            ->take(1)
            ->get();

        return Response::json(array(
            'error' => false,
            'urls' => $url->toArray()),
            200
        );
    }
}
