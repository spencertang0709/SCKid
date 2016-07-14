<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ContextPolicy;
use App\Beacon;
use App\Kid;

class PolicyController extends Controller
{
    public function store(Request $request)
    {
        // Validate our parameters
        $this->validate($request, [
            'appList' => 'required',
            'screenTime' => 'required',
            'startTime' => 'required',
            'endTime' => 'integer|required',
            'hiddenBeaconId' => 'required'
        ]);

        // var_dump($request);
        // echo $beacon_id
        echo 'beacon id:'.$request['hiddenBeaconId'].'<br>';
        $beacon=Beacon::find($request['hiddenBeaconId']);
        //$kidID = Session::get('current_kid');
        echo 'kid id:'.$request->session()->get('current_kid');
        //echo Session::get('current_kid');
        //$kidID=$request->session()->get('current_kid');
        $currentKid = Kid::find($request->session()->get('current_kid'));
        //$policy=ContextPolicy::create($request->all());
        $policy = new ContextPolicy();
        $policy->app_list=$request['appList'];
        $policy->screen_time=$request['screenTime'];
        $policy->start_time=$request['startTime'];
        $policy->end_time=$request['endTime'];

        //set the foreign key on the child model
        $policy->kid()->associate($currentKid);
        $policy->beacon()->associate($beacon);

        $policy->save();

		// $user = $request->user();
		// $beacon = App\Beacon::create($request->all());
		// $user->beacons()->attach($beacon->id);
        //return redirect('/beacons');
    }

}
