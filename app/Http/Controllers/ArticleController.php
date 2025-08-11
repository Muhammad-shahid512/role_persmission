<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Arg;

class ArticleController extends Controller
{

    public function index(){
        $article=Article::orderBy("title","ASC")->paginate(10);
        return view("article.display",compact("article"));
    }
    public function create(){
        return view("article.create");
    }
    public function store(Request $request){
        // return $request;
          $validator=Validator::make($request->all(),[
       'title'=>"required|unique:article",
       'author'=>"required"
        ]);

        if($validator->passes()){

            $article=new Article();
            $article->title=$request->title;
            $article->author=$request->author;
            $article->save();

return redirect()->route('articles')->with('message',"Article Create successfully added");
        }
        else{
            return redirect()->route('article.create')->withErrors($validator);
        }
    }


    public function edit($id){
        $article=Article::findOrFail($id);
        return view('article.update',compact("article"));
    }

public function update(Request $request,$id){
    
            $article=Article::findOrFail($id);
                   
       $validator=Validator::make($request->all(),[
       'title'=>"required",
       'author'=>"required"
        ]);

        if($validator->passes()){

            $article->title=$request->title;
            $article->author=$request->author;
            $article->save();

return redirect()->route('articles')->with('message',"Article Updated successfully");
        }
        else{
            return redirect()->route('article.edit')->withErrors($validator);
        }
}



public function delete($id){
                $article=Article::findOrFail($id);
$article->delete();
return redirect()->route('articles')->with('message',"Article delete successfully");

}

}
