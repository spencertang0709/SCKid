<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Title;
use App\Article;
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

    public function articleSearch(Request $request){
      $this->validate($request, [
          'keyword' => 'required',
      ]);
	  
      $keyword = $request['keyword'];
      $categories = Category::where('name', $keyword)->get();
      echo "Category:";
      echo "<br>";
      foreach($categories as $c){
	      echo $c->id.": ";
	      echo $c->name.",";
      }
	  
      echo "Title:";
      echo "<br>";
      $titles = Title::where('name', $keyword)->get();
      foreach($titles as $c) {
          echo $c->name.",";	
      }
      
      echo "Article";
      echo "<br>";
      $articles = Article::where('subheading', $keyword)->get();
      foreach($articles as $c){
	      echo $c->id.": ";
	      echo $c->subheading.",";
      }

      return view('knowledge.showSearchResult', [
          'categories' => $categories,
          'titles' => $titles,
          'articles'=> $articles
      ]);
    }
}
