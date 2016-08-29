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
      $categories = DB::table('categories')->distinct()->get(['name']);
      return view('knowledge.addArticle',['categories' => $categories]);
    }

    //save title, article and category
    public function saveArticle(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'article' => 'required',
        'content' => 'required|min:5',
      ]);

    //   $category = new Category();
    //   $category->name = $request['category'];
    //   $category->save();

      $category = Category::where('name',$request['category'])->first();

      $title = new Title();
      $title->name = $request['title'];
      $title->save();
      $title->categories()->attach($category->id);

      $article = new Article();
      $article->subheading = $request['article'];
      $article->content = htmlentities($request['content']);
      $article->save();
      $article->titles()->attach($title->id);

      return redirect()->back();
    }


    public function showCategory(){
    	$categories = Category::get();
    	return view('knowledge.showCategory', [
    		'categories' => $categories
    	]);
    }

    public function showTitle($category_id){
    	$category = Category::where('id', $category_id)->with('titles')->first();
    	$title = $category->titles()->get();
    	return view('knowledge.showTitle', [
    		'titles' => $title
    	]);
    }

    public function showArticle($title_id){
    	$title = Title::where('id', $title_id)->with('articles')->first();
    	$article = $title->articles()->first();

    	return view('knowledge.showArticle', [
    		'article' => $article
    	]);
    }


}
