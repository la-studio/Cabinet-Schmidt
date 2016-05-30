<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Temoignage;
use App\Article;
use App\Partenaire;
use App\Competence;
use App\Echosarticle;

class HomeController extends Controller
{
    public function index() {
        $articles = Article::orderBy('created_at', 'desc')
        ->take(2)
        ->get();
        $echosarticles = Echosarticle::orderBy('date','desc')
        ->take(2)
        ->get();
        $temoignages = Temoignage::all();
        $partenaires = Partenaire::all();
        $competences = Competence::all();
        return view('home', compact('articles', 'temoignages', 'partenaires','competences','echosarticles'));
    }
}
