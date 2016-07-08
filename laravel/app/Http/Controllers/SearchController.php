<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{

    public function knowledgeSearch(Request $request)
    {
        //Gets string from our form submission
//        $query = $request->input('search');
//
//        $articles = DB::table('articles')->where('title', 'LIKE', '%'.$query.'%')->paginate(10);
//
//        return view('knowledge.search',compact($articles,'query'));


        $test = array('1','2','4');
        return view('knowledge.search',['test' => $test]);
    }
}
