<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;
use App\Category;
use DB;

class KnowledgeEditController extends Controller
{
    //get the inital data form database
    public function index(Request $request)
    {
        $categories = DB::table('categories')->distinct()->get(['name']);
        $firstCategory = App\Category::first();
        $titles = $firstCategory->titles()->get();

        //$content = $titles->first()->articles->first()->get(['content']);
        $content = $titles->first()->articles()->first()->content;
        // var_dump($content);
        return view('knowledge.editKnowledge',[
            'categories' => $categories,
            'titles' => $titles,
            'content' => $content,
        ]);
    }

    public function updateTitle(Request $request)
    {
        $categories = DB::table('categories')->distinct()->get(['name']);
        $firstCategory = App\Category::first();
        $titles = $firstCategory->titles()->get();

        //$content = $titles->first()->articles->first()->get(['content']);
        $content = $titles->first()->articles()->first()->content;
        // var_dump($content);
        return view('knowledge.editKnowledge',[
            'categories' => $categories,
            'titles' => $titles,
            'content' => $content,
        ]);
    }

}
