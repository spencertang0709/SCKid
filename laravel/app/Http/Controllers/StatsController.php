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
        $locations = DB::table('locations')->orderBy('updated_at', 'desc')->take(5)->get();

        //$sms = DB::table('sms')->orderBy('updated_at', 'desc')->first();
        $sms = DB::table('sms')
        ->select('contact', DB::raw('COUNT(contact) as count'))
        ->groupBy('contact')
        ->orderBy('count','desc')
        ->take(5)
        ->get();

        //get current kid id
        $currentKidId = Session::get('current_kid', $request->id);

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
            ->get();
            //get all the calls corresponding to current kid
            //$calls = Kid::find($currentKidId)->calls()->get();
            $calls = DB::table('kids')->where('kids.id',$currentKidId)
            ->join('calls','kids.id','=','calls.kid_id')
            ->orderBy('start_time')
            ->get();
            //get all the sms corresponding to current kid
            $smss = Kid::find($currentKidId)->smss()->orderBy('time')->get();
            $i = 0;
            if($smss != null)
            {
                foreach($smss as $s)
                {
                    $smsDateTime[$i] = date_create($s->time)->format('Y-m-d');
                    $i++;
                }
            }
$user = $request->user()->get();
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
