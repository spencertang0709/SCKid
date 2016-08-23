<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswrodController extends Controller
{
    //use ResetsPasswords;

    /**
    * Create a new password controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
    * Reset password for a user
    *
    * @return void
    */
    public function change(Request $request)
    {
        //Validate our parameters
        $this->validate($request, [
            'old_password' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|max:255',
        ]);
        $user = $request->user();

        //make sure logged in account is user
        Auth::login($user);
        //if new password matches confirmed password
        if($request['password'] === $request['password_confirmation']){
            //If password match then save new passowrd
            if (Hash::check($request['old_password'], $user->password)) {
                // The passwords match...
                $user->password = bcrypt($request['password']);
                $user->update();
            }else{
                return redirect()->back()->with('msg','Please check your current password!');
            }
        }else{
            return redirect()->back()->with('msg','Please confirm your password! ');
        }
        return view('settings');
    }
}
