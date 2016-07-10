<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class KnowledgeAddArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        // //Validate our parameters
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'age' => 'integer'
        // ]);
        // $user = $request->user();
        // $kid = App\Kid::create($request->all());
        //

        // //This is working correctly!
        // $kid->users()->attach($user->id);
        //
        // return redirect('/kids');
      return view('knowledge.addArticle');
    }
}
