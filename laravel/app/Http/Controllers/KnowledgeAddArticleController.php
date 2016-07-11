<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Category;
use App\Title;
use App\Article;

class KnowledgeAddArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  KidRepository  $kids
     * @return void
     */
    // public function __construct(KidRepository $kids)
    // {
    //     //Requires authentication
    //     $this->middleware('auth');
    //
    //     //Type hinting for repository in app/Repository/KidRepository
    //     $this->kids = $kids;
    // }

    public function index(Request $request)
    {
      $categories=DB::table('categories')->get();
      return view('knowledge.addArticle',['categories'=>$categories]);
    }

    public function saveArticle(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'article'=>'required'
      ]);

      // echo $request['category'];
      // echo "this is test";
      
      $category = new Category();
      $category->name = $request['category'];
      $category->save();

      $title = new Title();
      $title->name = $request['title'];
      $title->save();
      $title->categories()->attach($category->id);

      $article = new Article();
      $article->subheading = $request['article'];
      $article->content = $request['content'];
      $article->save();
      $article->titles()->attach($title->id);

      return redirect()->back();
    }
}
