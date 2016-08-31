<?php

namespace App\Http\Controllers;

use App\Repository\KidRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App;
use App\Kid;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

//This controller is for managing kids
class KidController extends Controller
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
     * Display a list of all of the user's kids
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
//        //Get all of current kids and show to user
//        $kids = $request->user()->kids()->get();
//
//        //Kids will be accessible in our home view
//        return view('home', ['kids' => $kids,]);

        //Alternative using Repository and Type hinting

        //Session::put('current_kid', -1);

        return view('kids', [
            'kids' => $this->kids->forUser($request->user()),
        ]);
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
        $kid->timeSlots()->detach();
        $kid->socialMedias()->detach();
        $kid->apps()->detach();
        $kid->websites()->detach();
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
        $kid = App\Kid::findOrFail($id);

        Storage::put(
            'avatars/'.$kid->id,
            file_get_contents($request->file('avatar')->getRealPath())
        );
    }

    public function svAvatar(Request $request){

        $user = $request->user();
        $kidId = $request['kid'];
        // var_dump($request->images->path());
        // $filePath=$request->images->path();
        // $file = $request->file('images');
        // var_dump($file);

        $filename = $user->name . '-' . $kidId . '.jpg';
        // if ($file) {
        //     Storage::disk('local')->put($filename, $file);
        // }
        //  return redirect()->route('avatar');
        //  return Redirect::back()->with('msg', $filename);
        // return Redirect::back()->with('kidId', $kidId);
        return Redirect::back()->with('filename', $filename);
    }

    public function initialAvatar(Request $request){
        $user = $request->user();
        $kid = $user->kids()->get();
        return view('/addAvatar',[
            'kids' => $kid,
            'user' => $user,
            // 'kidId' => $kid->first()->id
    ]);
    }

    public function getKIdImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
