<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppController extends Controller
{
    public function index(Request $request)
    {
    	$apps = NULL;
        //This returns apps that the current child is using on there device
        $kidID = Session::get('current_kid');
		$currentKid = App\Kid::find($kidID);
		if ($currentKid != NULL) {
			$apps = $currentKid->apps()->get();	
		}
		
        //Get all of current kids and show to user
        //$apps = DB::table('apps')->get();

        //Pagination
	    //$apps = DB::table('apps')->paginate(15);


        //Chunking to speed things up?
//        User::chunk(200, function($users)
//        {
//            foreach ($users as $user)
//            {
//                //
//            }
//        });
	
        //Kids will be accessible in our home view
        return view('apps', ['apps' => $apps ]);
    }
    /**
     * Update app's block status in database
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'action' => 'required|max:1'
        ]);
        var_dump($request);

        DB::table('apps')
            ->where('id',$request->input('id'))
            ->update(['blocked' => $request->action]);
        //return redirect('/apps');
    }

    /**
     * Create a new app in the list to monitor
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        //Retrieve the app by instance or create if does not exist
        //$app = App::firstOrCreate($request->all());

//        $this->validate($request, [
//            'name' => 'required|max:255',
//            'package' => 'integer|required|max:255',
//            'blocked' => 'integer|required|max:255'
//        ]);

        //mass assignment
        $app = App::create($request->all());

        return redirect('/apps');
    }
}
