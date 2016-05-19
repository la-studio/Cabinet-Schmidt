<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temoignage;
use App\Article;
use App\Http\Requests;

class ActusController extends Controller {
    public function index() {
        $articles = Article::orderBy('created_at', 'desc')
        ->take(2) //->sortBy('created_at');
        ->get();
        // I could have done Article::all() to not have to use get() but this way laravel crashs and says taht orderBy is an undefined method.
        $temoignages = Temoignage::all();
        $data = ['articles'=>$articles,'temoignages'=> $temoignages];
        return view('actusgallery')->with('data',$data);
    }
}
