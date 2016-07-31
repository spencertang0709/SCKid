<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Kid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $kid = $request->input('kid_id');

        //TODO complex query
        $apps = DB::table('app_kid')->where('kid_id', '=', $kid)->get();

        return Response::json(
            array(
                'error' => false,
                'status' => '200',
                'apps' => $apps)
        );
    }

    /**
     * Store a newly created app in storage
     *
     * @return Response
     */
    public function store(Request $request)
    {
//        //Limit the request sent to this function
//
//        //Get this device info
//        $device = Device::find($request->input('device_id'));
//
//        //Get kids from device id
//        $kid = $device->kids();
//
//        //Insert into kid_app table or apps if the app isn't found
//        DB::transaction(function (Request $request, $kid) {
//
////            loop over all apps
//
//            //firstOrNew, firstOrFail
//
//            $id = DB::table('apps')->updateOrFail($kid->id);
//            DB::table('app_kid')->updateOrFail($request->input('apps'));
//        });

        $id = $request->input('kid.id');
        $apps = $request->input('kid.apps');

        $kid = Kid::find($id);
        $kid->apps()->createMany($apps);

        return Response::json(
            array(
                'kid' => $kid,
                'apps' => $apps,
                'status' => 'Success Added Apps!')
        );
    }

    /**
     * Shows a resource from $id
     *
     * @return Response
     */
    public function show($id)
    {
        //TODO authorisations
        $kid = Kid::find($id);
        $apps = $kid->apps()->get();

        return Response::json(
            array(
                'error' => false,
                'status' => '200',
                'kid' => $kid,
                'apps' => $apps)
        );
    }
}
