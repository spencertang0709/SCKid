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

class StatsController extends Controller
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

    public function index(Request $request)
    {
        $startPickTime = Session::get('startPickTime');
        $endPickTime = Session::get('endPickTime');

        //get current kid id
        $currentKidId = Session::get('current_kid', $request->id);

        $locations="";

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
            $locations = Kid::find($currentKidId)->locations()
            ->whereBetween('time',[$startPickTime,$endPickTime])
            ->orderBy('updated_at', 'desc')->get();
            // $apps=Kid::find($currentKidId)->apps()->get();
            $topApp = DB::table('app_kid')->where('kid_id',$currentKidId)
            ->join('apps','app_kid.app_id','=','apps.id')
            ->select('package', DB::raw('COUNT(*) as count'))
            ->groupby('package')
            ->orderBy('count','desc')
            ->take(8)
            ->get();

            $calls = Kid::find($currentKidId)->calls()->whereBetween('start_time',[$startPickTime,$endPickTime])->orderBy('start_time')->get();
            //get all the sms corresponding to current kid
            $smss = Kid::find($currentKidId)->smss()->whereBetween('time',[$startPickTime,$endPickTime])->orderBy('time')->get();
            $i = 0;
            if($smss != null)
            {
                foreach($smss as $s)
                {
                    $smsDateTime[$i] = date_create($s->time)->format('Y-m-d');
                    $i++;
                }
            }
            return view('stats',[
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
            return view('stats',[
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
