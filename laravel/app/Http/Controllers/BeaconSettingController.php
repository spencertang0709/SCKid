<?php

namespace App\Http\Controllers;

use App;
use App\Repository\BeaconSettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Yaml\Tests\B;
use Illuminate\Support\Facades\Auth;

//This controller is for managing beacon settings
class BeaconSettingController extends Controller
{

	/**
     * The task repository instance.
     *
     * @var BeaconSettingRepository
     */
    protected $beacon_settings;

	/**
     * Create a new controller instance.
     *
     * @param  BeaconSettingRepository  $beacon_settings
     * @return void
     */
    public function __construct()//BeaconSettingRepository $beacon_settings)
    {
        //Requires authentication
        $this->middleware('auth');

        //Type hinting for repository
        //$this->beacon_settings = $beacon_settings;
    }

	 /**
     * Display a list of all of the beacon settings
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
		/**
		*existing beacons for corresponding child
		*/
		//display all the beacons to corresponding user
		//$beacons = null;
		//echo 'connect correctly';
		$user = $request->user();
		//echo $user;
		$beacons = $user->beacons()->get();

		//display policy according to kid and beacons
		$kidID = Session::get('current_kid');
		$apps=null;
		$currentKid = App\Kid::find($kidID);
		if ($currentKid != NULL) {
			//$beacons = $currentKid->beacons()->get();
			$apps = $currentKid->apps()->get();
		}

		/**
		*location aware policy
		*/
	 	//$kids=$user->kids()->get();

		//join users kids policies and beacons tables
		$awarePolicies = DB::table('kid_user')->where('user_id',$user->id)
            ->join('kids', 'kid_user.kid_id', '=', 'kids.id')
            ->join('context_policies', 'kids.id', '=', 'context_policies.kid_id')
			->join('beacons', 'context_policies.beacon_id', '=', 'beacons.id')
            ->select('kids.name','context_policies.*','beacons.location')
            ->get();

		return view('beacons',[
		'beacons' => $beacons,
		//'kids' => $kids,
		'apps' => $apps,
		'awarePolicies' =>$awarePolicies
	]);

    	// $beacons = NULL;
		//
		// //Get the beacons that are linked to the current kid
        // $kidID = Session::get('current_kid');
        // $currentKid = App\Kid::find($kidID);
		// if ($currentKid != NULL) {
		// 	$beacons = $currentKid->beacons()->get();
		// }
		//
		// return view('beacons', ['beacons' => $beacons]);

		//TODO return all beacons if we want
//		//Return all the beacons for all existing kids
//		$kids = $request->user()->kids()->get();
//		$allBeacons = collect();
//
//		foreach ($kids as $kid) {
//			$beacons = $kid->beacons()->get();
//			foreach ($beacons as $beacon) {
//				$allBeacons->prepend($beacon);
//			}
//		}
    }

	/**
     * Create a new beacon setting.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //Validate our parameters
        $this->validate($request, [
            'location' => 'required|max:255',
            'major' => 'integer|required',
            'minor' => 'integer|required'
        ]);

		$user = $request->user();
		$beacon = App\Beacon::create($request->all());
		$user->beacons()->attach($beacon->id);
        return redirect('/beacons');

        // $kidID = Session::get('current_kid');
        // $currentKid = App\Kid::find($kidID);
		//
        // $beacon = App\Beacon::create($request->all());
		//
        // $currentKid->beacons()->attach($beacon->id);

        //Three different ways to create beacons
//        Creating unlinked beacons
//        DB::table('beacons')->insert(
//                ['location' => $request->location, 'minor' =>$request->minor, 'major' => $request->major]
//        );

        //object
//        $beacon = new Beacon;
//        $beacon->location = $request->location;
//        $beacon->major = $request->major;
//        $beacon->minor = $request->minor;
//        $beacon->save();

        //mass assignment
        //$beacon1 = Beacon::create($request->all());
     }


	/**
	 * Delete selected beacon setting
	 *
	 * @param Request $request
	 * 		  Beacon $beacon_setting
	 * @return Response
	 */
	 public function destroy(Request $request, App\Beacon $beacon_setting)
     {
        //This is our authorise request for to check policies
        //TODO not sure how to authorize
     	//$this->authorize('destroy', $beacon);
		//echo $beacon_setting->id;
		$beacon_setting->delete();
        return redirect('/beacons')->with(['message' => 'Successfully deleted!']);
     }
}
