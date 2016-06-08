<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Digitarticle;
use App\Http\Requests;

class DigitController extends Controller
{
    public function index()
    {
        $digitarticles = Digitarticle::all();
        return view('chiffres',compact('digitarticles'));
    }
    public function show($slug)
    {
        $article = Digitarticle::where('slug',"=",$slug)->get();
        $unique_article = Digitarticle::where('slug',"=",$slug)->take(1)->get();
        $compacted_article = $unique_article[0];
        $rubrique = $article[0]->rubrique;
        if(preg_match('/\s/',$rubrique)>0) {
            $rubriques =  preg_split('/\s+/', $rubrique);
            $suggestions = [];
            foreach($rubriques as $element) {
                $collection = Digitarticle::where('rubrique','LIKE','%'.$element.'%');
                $len = $collection->count();
                $randIndex = rand(0,$len);
                $pick = $collection->skip($randIndex)->take(2)->get();
                if(count($pick)<2) {
                    $collection = Digitarticle::all();
                    $pick = $collection->take(2)->get();
                    array_push($suggestions, $pick); // find by rand
                } else {
                    array_push($suggestions, $pick); // mettre le desordre dans le tableau
                }
            }
            $result = [$suggestions[0][0],$suggestions[0][1],$suggestions[1][0]];
            return view('actus.article',compact('compacted_article','result'));
        } else {
            $collection = Digitarticle::where('rubrique',"=",$rubrique);
            $len = $collection->count();
            $randIndex = rand(0,$len);
            $result = $collection->skip($randIndex)->take(3)->get();
            if(count($result)<3) {
                $collection = Digitarticle::all();
                $len = $collection->count();
                $randIndex = rand(0,$len);
                $result = $collection->skip($randIndex)->take(3)->get(); // find by rand
            }
            return view('chiffres.article',compact('compacted_article','result'));
        }
    }
}
