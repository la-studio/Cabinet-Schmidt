<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Redirect;
use App\Http\Requests;

class ArticlesController extends Controller
{
    public function show(Article $id)
    {
        return view('admin.templates.article')->with('article',$id);
    }
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('admin.list.articles')->with('articles',$articles);
    }
    public function store(Request $request)
    {
        $article = new Article($request->all());
        $article->save();
        return redirect('/admin/articles');
    }
    public function destroy(Article $id)
    {
        $id->delete();
        return redirect('/admin/articles');
    }
    public function update(Request $request, Article $id)
    {
        $id->update($request->all());
        return redirect('/admin/articles');
    }
    public function create()
    {
        return view('admin.new.article');
    }
}
