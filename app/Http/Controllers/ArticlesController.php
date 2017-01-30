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
        return view('admin.templates.article')->with('article', $id);
    }
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('admin.list.articles')->with('articles',$articles);
    }
    public function store(Request $request)
    {
        $article = new Article($request->all());

        if(!is_null($request->image)){
            $file = $request->image;
            $destinationPath = public_path()."/images/articles";
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $article->image = "/images/articles/".$filename; // Filling this property manually
        }
        $article->slug = $this->slugify($request->title); 
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
        $id->update($request->except('image', 'slug'));
        $id->slug = $this->slugify($request->title); 
        $id->update(['slug' => $id->slug]);

        if(!is_null($request->image)){
            $file = $request->image;
            $destinationPath = public_path()."/images/articles";
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $id->image = "/images/articles/".$filename; // Filling this property manually
            $id->update(['image' => $id->image]);
        }

        return redirect('/admin/articles');
    }
    public function create()
    {
        return view('admin.new.article');
    }

    private function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
        return 'n-a';
        }

        return $text;
    }
}
