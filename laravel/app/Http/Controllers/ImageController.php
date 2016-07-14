<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ImageController extends Controller
{
    public function index()
    {
        $albums = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
        $currentKid = App\Kid::find($kidID);
        if ($currentKid != NULL) {
            $kid = $currentKid->socialMedias()->get()->first();
            if($kid!=NULL) {
                $albums = $kid->albums()->get();
            }
        }
        return view('image',['albums' => $albums]);
    }
}
