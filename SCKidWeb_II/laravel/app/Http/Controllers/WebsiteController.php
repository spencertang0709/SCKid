<?php

namespace App\Http\Controllers;

use App\Kid;
use App\Website;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    /**
     * Create a new website instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the request...
        $website = new Website;
        $website->name = $request->name;
        $website->host = $request->host;
        $website->ip = $request->ip;
        $website->type = $request->type;
        $website->save();

        return redirect('/websites');
    }


    /**
     * Show a list of all websites blocked for child
     *
     * @return Response
     */
    public function index()
    {
    	$websites = NULL;
		
        $kidID = Session::get('current_kid');
        $currentKid = Kid::find($kidID);
		if ($currentKid != NULL) {
			$websites = $currentKid->websites()->get();	
		}
        
        return view('websites', ['websites' => $websites]);
    }


    /**
     * Delete website blocking for child
     *
     */
    public function destroy(Request $request, Website $website)
    {
        //This is our authorise request for to check policies
        //TODO authorisation and only show websites for kid
//        $this->authorize('destroy', $website);
        
        $website->delete();
        return redirect('websites');
    }
}
