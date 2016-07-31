<?php

namespace App\Http\Controllers;

use App\Jobs\SendRegistrationEmail;
use App\User;
use Illuminate\Http\Request;
use Mail;

class UserController extends Controller
{

    //https://laravel.com/docs/5.2/mail
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);

//
//        Mail::send('emails.mail', ['user' => $user], function ($m) use ($user) {
//            $m->from('hello@app.com', 'Your Application');
//
//            $m->to($user->email, $user->name)->subject('Your Reminder!');
//
//        });

        //Raw strings
        Mail::raw('Text to email',function($message){
            $message->from('sckid@sckid.nz', 'Laravel');
            $message->to('edridge.ben@gmail.com');
        });

//        https://laravel.com/docs/5.2/queues
        //Queue messages
//        Mail::queue('emails.welcome', $data, function ($message) {
//            //
//        });
    }

    public function sendEmail(Request $request)
    {
        //Raw strings
        Mail::raw('Text to email',function($message){
            $message->from('sckid@sckid.nz', 'Laravel');
            $message->to('edridge.ben@gmail.com');
        });
    }



    /**
     * Send an e-mail registration token to user
     *
     * @param  Request  $request
     * @param  int  $id
     */
    public function sendRegistrationEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //Pushes job onto queue
        $this->dispatch(new SendRegistrationEmail($user));

        //Delaying in queue for 5min before being available
        //$this->dispatch(new SendRegistrationEmail($user))->delay(60*5);
    }
}
