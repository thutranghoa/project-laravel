<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function test (){
        echo "This is the view action of NewsController ";
    } 

    public function view(){
        return view('myview');
    }

    public function add (){
        return view('news.insertform');
    }

    public function insert (Request $request){
        $news = new News();
        $news->name = $request->name;
        $news->description = $request->description;
        $news->author = $request->author;
        $news->save();
        return redirect()->route('news.addnew');
    }

    public function edit ($id){
        $news = News::find($id);
        return view('news.editform', ['news' => $news]);
    }

    public function update (Request $request){
        $news = News::find($request->id);
        $news->name = $request->name;
        $news->description = $request->description;
        $news->author = $request->author;
        $news->save();
        return redirect()->route('news.edit', ['id' => $request -> id]);
    }

    public function delete ($id){
        $news = News::find($id);
        $news->delete();
    }

    public function list (){
        $news = News::all();
        return view('news.list', ['news' => $news]);
    }

}
