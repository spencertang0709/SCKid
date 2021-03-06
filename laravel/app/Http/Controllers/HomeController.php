<?php
namespace App\Http\Controllers;

use App\Repository\KidRepository;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Kid;
use DateTime;

class HomeController extends Controller
{
	/**
     * The task repository instance.
     *
     * @var KidRepository
     */
    protected $kids;

    /**
     * Create a new controller instance.
     *
     * @param  KidRepository  $kids
     * @return void
     */
    public function __construct(KidRepository $kids)
    {
        //Requires authentication
        $this->middleware('auth');

        //Type hinting for repository in app/Repository/KidRepository
        $this->kids = $kids;
    }
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$isAdmin = false;
    	$roles = $request->user()->roles()->get();
		foreach ($roles as $role) {
			if ($role->name == "admin") {
				$isAdmin = true;
			}
		}
		if ($isAdmin) {
			return view('home2');
		} else {
			//get current kid id
			$currentKidId = Session::get('current_kid', $request->id);
			$locations="";
			//$locations = DB::table('locations')->orderBy('updated_at', 'desc')->take(5)->get();
			if($currentKidId!=null){
				$locations = Kid::find($currentKidId)->locations()->orderBy('updated_at', 'desc')->take(10)->get();
			}
	        //$sms = DB::table('sms')->orderBy('updated_at', 'desc')->first();
	        $sms = DB::table('sms')
	            ->select('contact', DB::raw('COUNT(contact) as count'))
	            ->groupBy('contact')
	            ->orderBy('count','desc')
	            ->take(5)
	            ->get();


			$topApp=[];
			$calls=[];
			$smss=[];
			$smsDateTime = [];
			if($currentKidId!=null){
				// $apps=Kid::find($currentKidId)->apps()->get();
				$topApp = DB::table('app_kid')->where('kid_id',$currentKidId)
				->join('apps','app_kid.app_id','=','apps.id')
				->select('package', DB::raw('COUNT(*) as count'))
				->groupby('package')
				->take(8)
				->get();
				//get all the calls corresponding to current kid

				$calls = Kid::find($currentKidId)->calls()->orderBy('start_time')->get();
				//get all the sms corresponding to current kid
			 	$smss = Kid::find($currentKidId)->smss()->orderBy('time')->get();
				//  $smss = Kid::find(101)->smss()->orderBy('time')->get();
				$i = 0;
				if($smss != null)
				{
				 foreach($smss as $s)
				 {
					 $smsDateTime[$i] = date_create($s->time)->format('Y-m-d');
					 $i++;
					 //  array_push($smsDateTime,date_create($s->time)->format('m-d'));
					 // $smsdt=date_create($s->time)->format('m-d');
					 // $smsDateTime
				 }
			 	}

		        return view('home',[
		        	'locations' => $locations,
		        	'sms'=>$sms,
					'kids' => $this->kids->forUser($request->user()),
			 		'currentKidId' => $currentKidId,
					'topApp' => $topApp,
					'calls' => $calls,
					'smss' => $smss,
					'time' => $smsDateTime,
					// 'apps' => $apps,
				]);
			}else {
				return view('home',[
		        	'locations' => $locations,
		        	'sms'=>$sms,
					'kids' => $this->kids->forUser($request->user()),
					'currentKidId' => $currentKidId,
					'topApp' => $topApp,
					'calls' => $calls,
					'smss' => $smss,
					'time' => $smsDateTime,
					// 'apps' => $apps,
				]);
			}
		}
    }

	 /**
     * Create a new kid.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //Validate our parameters
        $this->validate($request, [
            'name' => 'required|max:255',
            'age' => 'integer'
        ]);

//        $kid = Kid::create([
//            'name' => $request->name,
//            'age' => $request->age,
//        ]);

        $user = $request->user();
        $kid = App\Kid::create($request->all());

        //This is working correctly!
        $kid->users()->attach($user->id);

        //Saving kid created for the current user
//        $request->user()->kids()->attach($kid);

        //Create The Kid...
        //Gets id of current user $request->user()
//        $request->user()->kids()->create([
//            'name' => $request->name,
//            'age' => $request->age,
//        ]);

        //This attaches to relationship aswell
//        $request->user()->kids()->attach($request->user())->save();

//        $url = Storage::url('file.txt');

        return redirect('/kids');
    }


//Kid $kid

    public function destroy(Request $request, Kid $kid)
    {
        //This is our authorise request for to check policies
        $this->authorize('destroy', $kid);

        //Detaching all relationships in many to many tables
        $kid->beacons()->detach();
        $kid->users()->detach();

        //We can now delete the kid
        $kid->delete();

        return redirect('/kids');
    }


    /**
     * Update the avatar for the given user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function updateAvatar(Request $request, $id)
    {
        $kid = App\Kid::OrFail($id);

        Storage::put(
            'avatars/'.$kid->id,
            file_get_contents($request->file('avatar')->getRealPath())
        );
    }
}
