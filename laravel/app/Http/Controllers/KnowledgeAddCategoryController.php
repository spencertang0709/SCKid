<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App;

class KnowledgeAddCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
      return view('knowledge.addCategory');
    }

    //save category
    public function saveCategory(Request $request)
    {
      $this->validate($request, [
        'newCategory' => 'required',
      ]);

      $category = new App\Category();
      $category->name = $request['newCategory'];
      $category->save();
      echo "success";     
    }
}
