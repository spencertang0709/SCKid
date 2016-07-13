<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PolicyController extends Controller
{
    public function store(Request $request)
    {
        //Validate our parameters
        // $this->validate($request, [
        //     'screenTime' => 'required',
        //     'startTime' => 'required',
        //     'endTime' => 'required'
        // ]);

        // var_dump($request);
        // echo $beacon_id
        echo $request['hiddenBeaconId'];
        // $policy=App\ContextPolicy::create($request->all());
        // $policy->beacons()->attach($beacon->id);

		// $user = $request->user();
		// $beacon = App\Beacon::create($request->all());
		// $user->beacons()->attach($beacon->id);
        //return redirect('/beacons');
    }

}
