<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Digitarticle;
use App\Http\Requests;
use DB;

class DigitController extends Controller
{
    public function index()
    {
        $digitarticles = DB::table('digitarticles')->orderBy('date', 'desc')->paginate(6);
        $page = 'digit';
        return view('chiffres', compact('digitarticles', 'page'));
    }

    public function indexByCategory($rubrique)
    {
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
        $digitarticles = Digitarticle::whereRaw($query)->orderBy('date', 'desc')->paginate(6);
        $page = $rubrique;
        return view('chiffres', compact('digitarticles', 'page'));
    }

    public function show($slug)
    {
        $article = Digitarticle::where('slug',"=",$slug)->get();
        $unique_article = Digitarticle::where('slug',"=",$slug)->take(1)->get();
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
            $collection = Digitarticle::whereRaw($query)->get();
            if($collection->count()<3){
                $result = $collection->random($collection->count());
            }else{
                $result = $collection->random(3);
            }
        } else {
            $collection = Digitarticle::where('rubrique',"=",$rubrique)->get();
            if($collection->count()<3){
                $result = $collection->random($collection->count());
            }else{
                $result = $collection->random(3);
            }
        }
        return view('chiffres.article',compact('compacted_article','result'));
    }
}
