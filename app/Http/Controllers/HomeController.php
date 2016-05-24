<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Temoignage;
use App\Article;
use App\Partenaire;

class HomeController extends Controller
{
    public function index() {
        $articles = Article::orderBy('created_at', 'desc')
        ->take(2)
        ->get();
        // I could have done Article::all() to not have to use get() but this way laravel crashs and says taht orderBy is an undefined method.
        $temoignages = Temoignage::all();
        $partenaires = Partenaire::all();
        return view('home', compact('articles', 'temoignages', 'partenaires'));
    }
}
