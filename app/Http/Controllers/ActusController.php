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
        $echosarticles = Echosarticle::orderBy('date','desc')
        ->take(9)
        ->get();
        $temoignages = Temoignage::all();
        return view('actusgallery', compact('articles','echosarticles'));
    }
}
