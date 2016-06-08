<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temoignage;
use App\Article;
use App\Echosarticle;
use App\Http\Requests;

class ActusController extends Controller {
    public function index() {
        $articles = Article::orderBy('created_at', 'desc')
        ->take(2)
        ->get();
        $echosarticles = Echosarticle::orderBy('date','desc')->get();
        $temoignages = Temoignage::all();
        return view('actusgallery', compact('articles','echosarticles'));
    }
    public function redirect($id)
    {
        $article= Echosarticle::where('article_id','=',$id)->get();
        return redirect('/actus/'.$article[0]->slug);
    }
    public function show($slug)
    {
        $article = Echosarticle::where('slug',"=",$slug)->get();
        $unique_article = Echosarticle::where('slug',"=",$slug)->take(1)->get();
        $compacted_article = $unique_article[0];
        $rubrique = $article[0]->rubrique;
        if(preg_match('/\s/',$rubrique)>0) {
            $rubriques =  preg_split('/\s+/', $rubrique);
            $suggestions = [];
            foreach($rubriques as $element) {
                $collection = Echosarticle::where('rubrique','LIKE','%'.$element.'%');
                $len = $collection->count();
                $randIndex = rand(0,$len);
                $pick = $collection->skip($randIndex)->take(2)->get();
                if(count($pick)<2) {
                    $collection = Echosarticle::all();
                    $pick = $collection->take(2)->get();
                    array_push($suggestions, $pick); // find by rand
                } else {
                    array_push($suggestions, $pick); // mettre le desordre dans le tableau
                }
            }
            $result = [$suggestions[0][0],$suggestions[0][1],$suggestions[1][0]];
            return view('actus.article',compact('compacted_article','result'));
        } else {
            $collection = Echosarticle::where('rubrique',"=",$rubrique);
            $len = $collection->count();
            $randIndex = rand(0,$len);
            $result = $collection->skip($randIndex)->take(3)->get();
            if(count($result)<3) {
                $collection = Echosarticle::all();
                $len = $collection->count();
                $randIndex = rand(0,$len);
                $result = $collection->skip($randIndex)->take(3)->get(); // find by rand
            }
            return view('actus.article',compact('compacted_article','result'));
        }
    }
}
