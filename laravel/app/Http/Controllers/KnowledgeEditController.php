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

        $article = $titles->first()->articles()->first();
        return view('knowledge.editKnowledge',[
            'categories' => $categories,
            'titles' => $titles,
            'article' => $article,
        ]);
    }

    public function updateTitles(Request $request)
    {
        $selectedCategory = $request['selectedCategory'];
         $category = App\Category::where('name',$selectedCategory)->first();
        $titles = $category->titles()->get();

        $article = $titles->first()->articles()->first();

        $resTitleId = array();
        $resTitle = array();
        foreach($titles as $title){
            array_push($resTitle, $title->name);
            array_push($resTitleId,$title->id);
        }

        $resContent = array();
        array_push($resContent, $article->content);

        $returnValue = array();
        //var_dump($returnValue)
        $returnValue[0] = $resTitle;
        $returnValue[1] = $resContent;
        $returnValue[2] = $resTitleId;
        // var_dump($returnValue);
        echo json_encode($returnValue);
    }

    public function updateContent(Request $request){
        $selectTitle = $request['selectTitle'];
        // echo $selectTitle;
        $title = App\Title::find($selectTitle);
        // echo $title;
        $content = "";
        if($title!=null){
        $article = $title->articles()->first();
        $content = $article->content;
        $articleId = $article->id;
        }
        $returnValue = array();
        $returnValue[0] = $content;
        $returnValue[1] = $articleId;
        echo json_encode($returnValue);
    }

    //save title, article and category
    public function saveContent(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:5',
        ]);

        $article = App\Article::find($request['articleId']);
        $article->content = $request['content'];
        $article->update();
        return redirect('knowledge/edit');
    }
}
