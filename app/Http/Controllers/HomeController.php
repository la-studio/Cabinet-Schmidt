<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Temoignage;
use App\Article;
use App\Partenaire;
use App\Competence;
use App\Echosarticle;
use App\Appointment;
use App\Slider;
use DateTime;
use Illuminate\Support\Facades\DB;

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
        $slider = Slider::all();
        $appointmentLen = Appointment::all()->count();
        $temoignagesLen = $temoignages->count();
        $appointment = Appointment::orderBy('created_at','asc')->where('created_at','>', new DateTime())->first();
        if(!$echosarticles->isEmpty()){
            if(strlen($echosarticles[0]->title) > 85 || strlen($echosarticles[1]->title) > 85) {
                $is_large = true;
            } else {
                $is_large = false;
            }
        }
        return view('home', compact('articles', 'temoignages', 'partenaires','competences','echosarticles','appointment','temoignagesLen','is_large','slider'))->withCount($appointment);
    }

    public function show($slug)
    {
        $article = Article::where('slug',"=",$slug)->first();
        if(is_null($article)){
            return abort(404);
        }
        return view('home.article', compact('article'));
    }

    public function indexArticles(Request $request)
    {
        $articles = DB::table('articles')->orderBy('created_at', 'desc')->paginate(6);
        //dd($articles);
        return view('home.articles', compact('articles'));
    }
}
