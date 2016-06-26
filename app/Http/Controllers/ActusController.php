<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temoignage;
use App\Article;
use App\Echosarticle;
use App\Http\Requests;
use Log;

class ActusController extends Controller {
    public function index() {
        $articles = Article::orderBy('created_at', 'desc')
        ->take(2)
        ->get();
        $echosarticles = Echosarticle::orderBy('date','desc')->get();
        $temoignages = Temoignage::all();
        $is_large = true;
        $page = 'actu';
        return view('actusgallery', compact('articles','echosarticles', 'is_large', 'page'));
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
            for ($i = 0; $i < count($rubriques); $i++){
                if($i == 0){
                    $query = "(rubrique LIKE '%".$rubriques[$i]."%'";
                }elseif($i == ((count($rubriques)) - 1)){
                    $query .=  " OR rubrique LIKE '%".$rubriques[$i]."%')";
                }else{
                    $query .= " OR rubrique LIKE '%".$rubriques[$i]."%'";
                }
            }
            $collection = Echosarticle::whereRaw($query)->get();
            $result = $collection->random(3);
        } else {
            $collection = Echosarticle::where('rubrique',"=",$rubrique)->get();
            $result = $collection->random(3);
        }
        return view('actus.article',compact('compacted_article','result'));
    }
}
