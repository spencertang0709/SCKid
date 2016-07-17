<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Photo;
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
        //$photos_albums = Photo::all()->groupBy('album_id');
        $allphotos = array();
        if(count($albums)>0){
            foreach($albums as $album){
                //echo $album;

                $photos = $album -> Photos()->get()->toArray();

                $allphotos = array_merge($allphotos,$photos);
                //echo $photos;
            }
        }

        //echo $photos_albums;
        //echo $albums;
        return view('image',['albums' => $albums,'photos_albums' => $allphotos]);
    }
}
