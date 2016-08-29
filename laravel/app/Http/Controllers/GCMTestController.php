<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\DB;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;



class GCMTestController extends Controller
{
    //
    public function index(Request $request)
    {
        // $messages = array();
        // $messages['name'] = 'name';
        // $messages['title'] = 'title';
        // $messages['content'] = 'content';
        //
        // return view('GCMReceive',[
        //     'messages' => (object) $messages
        // ]);
        $messages=array();
        array_push($messages,
            ['IMEI' => 'fred',
            'title' => 'title11',
            'content' => 'content11']
        );

        array_push($messages,
        ['IMEI' => 'fred2',
        'title' => 'title2',
        'content' => 'content2']);

        array_push($messages,
        ['IMEI' => 'LikeController',
        'title' => 'transliterator',
        'content' => 'content2asdfasdf']);

        $device = App\Device::where('unique_id', 'beb6b6eb-af79-3246-a9cc-cb633d0da523')->first();
        //
        $message = new App\GcmMessage();
        $message->title = 'titleByfred';
        $message->content = 'contentByFred';
        $message->device()->associate($device);
        $message->save();

        //var_dump($message);
        echo json_encode($messages);
    }
}
