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
        if(strlen($echosarticles[0]->title) > 85 || strlen($echosarticles[1]->title) > 85) {
            $is_large = true;
        } else {
            $is_large = false;
        }
        return view('home', compact('articles', 'temoignages', 'partenaires','competences','echosarticles','appointment','temoignagesLen','is_large','slider'))->withCount($appointment);
    }
}
