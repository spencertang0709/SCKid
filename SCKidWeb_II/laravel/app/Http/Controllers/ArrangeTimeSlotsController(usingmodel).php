<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use App;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArrangeTimeSlotsController extends Controller
{
    public function arrange(Request $request) {
    	$currentKidID = Session::get('current_kid');
		
		$currentKid = App\Kid::find($currentKidID);
		
		$day = $request->day;
		$slots = json_decode($request->slots, true);
		
		foreach($slots as $start_time) {
			$start_time = $start_time.":00";
			
			//Get slot model
			$slotID = DB::table('times')
						->where('day', '=', $day)
						->where('start_time', '=', $start_time)
						->value('id');
			
			$currentKid->timeSlots()->attach($slotID);
			
		}
    }
}
