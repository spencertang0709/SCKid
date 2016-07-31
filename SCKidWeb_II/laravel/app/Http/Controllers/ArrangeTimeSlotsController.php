<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArrangeTimeSlotsController extends Controller
{
    public function arrange(Request $request) {
    	$currentKidID = Session::get('current_kid');
		
		/*TODO find the model and relate to the slot model
		$currentKid = App\Kid::find($currentKidID);
		||
		$results = DB::table('kids')
						->where('id', '=', $currentKidID)
						->get();
		foreach($results as $result) {
			$currentKid = $result;
		}
		 */
		
		$day = $request->day;
		$slots = json_decode($request->slots, true);
		
		foreach($slots as $start_time) {
			$start_time = $start_time.":00";
			
			//Get slot model
			$slotID = DB::table('times')
						->where('day', '=', $day)
						->where('start_time', '=', $start_time)
						->value('id');
			
			DB::table('kid_timeslot')
				->insert(
					['timeslot_id' => $slotID, 'kid_id' => $currentKidID]
				);
			//$currentKid->timeSlots()->attach($slotID);
		}
    }
}
