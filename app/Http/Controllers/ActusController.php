<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temoignage;
use App\Article;
use App\Echosarticle;
use App\Http\Requests;
use DB;

class ActusController extends Controller {
    public function index(Request $request) {
        $echosarticles = DB::table('echosarticles')->orderBy('date', 'desc')->paginate(6);
        if($echosarticles->isEmpty()){
            return view('errors.articlesNotFound');
        }
        if(strlen($echosarticles[0]->title) > 85 || strlen($echosarticles[1]->title) > 85) {
            $is_large = true;
        } else {
            $is_large = false;
        }
        $is_large = true;
        $page = 'actus';
        return view('actusgallery', compact('echosarticles', 'is_large', 'page'));
    }

    public function indexByCategory($rubrique) {
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
        }else{
            $query = "rubrique LIKE '%".$rubrique."%'";
        }
        $echosarticles = Echosarticle::whereRaw($query)->orderBy('date', 'desc')->paginate(6);
        if($echosarticles->isEmpty()){
            return view('errors.articlesNotFound');
        }
        if(strlen($echosarticles[0]->title) > 85 || strlen($echosarticles[1]->title) > 85) {
            $is_large = true;
        } else {
            $is_large = false;
        }
        $is_large = true;
        $page = $rubrique;
        return view('actusgallery', compact('echosarticles', 'is_large', 'page'));
    }

    public function redirect($id)
    {
        $article= Echosarticle::where('article_id','=',$id)->get();
        if($article->isEmpty()){
            return abort(404);
        }
        return redirect('/actualites/'.$article[0]->slug);
    }

    public function show($slug)
    {
        $article = Echosarticle::where('slug',"=",$slug)->get();
        if($article->isEmpty()){
            return abort(404);
        }
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
            if($collection->count()<3 && $collection->count()>0){
                $result = $collection->random($collection->count());
            }elseif($collection->count()>=3){
                $result = $collection->random(3);
            }
        } else {
            $collection = Echosarticle::where('rubrique',"=",$rubrique)->get();
            if($collection->count()<3 && $collection->count()>0){
                $result = $collection->random($collection->count());
            }elseif($collection->count()>=3){
                $result = $collection->random(3);
            }
        }
        return view('actus.article',compact('compacted_article','result'));
    }
}
