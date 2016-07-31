<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use DB;
use App;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class BeaconController extends Controller
{
    public function index(Request $request)
    {
    	$beacons = DB::table('beacons')
    				->select('location as beaconLocation', 'major', 'minor')
    				->get();
		
        return Response::json(
        	array (
        		'beaconsOnline' => $beacons
			)
        );
    }
}
