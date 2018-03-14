<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Auth routes
Route::auth();
Route::get('/logout','AuthController@logout');
Route::get('/register','AuthController@register');

// Admin routes.
Route::group(['prefix'=>'admin', 'middleware'=> 'auth'],function(){
    //Articles
    Route::get('/','AuthController@index');
    Route::get('dashboard','AdminController@index');
    Route::get('register', 'AuthController@register');
    Route::get('articles','ArticlesController@index');
    Route::get('article/edit/{id}', 'ArticlesController@show');
    Route::get('article/create', 'ArticlesController@create');
    Route::post('article/store', 'ArticlesController@store');
    Route::patch('article/update/{id}', 'ArticlesController@update');
    Route::delete('article/delete/{id}','ArticlesController@destroy');
    // Temoignages
    Route::get('temoignages', 'TemoignagesController@index');
    Route::get('temoignage/edit/{id}', 'TemoignagesController@show');
    Route::get('temoignage/create', 'TemoignagesController@create');
    Route::delete('temoignage/delete/{id}','TemoignagesController@destroy');
    Route::post('temoignage/store', 'TemoignagesController@store');
    Route::patch('temoignage/update/{id}', 'TemoignagesController@update');
    
    //Slider
    Route::get('slider', 'SliderController@index');
    Route::get('slide/edit/{id}', 'SliderController@show');
    Route::patch('slider/update/{id}', 'SliderController@update');
    //Partenaires
    Route::get('partenaires', 'PartenairesController@index');
    Route::get('partenaire/edit/{id}', 'PartenairesController@show');
    Route::get('partenaire/create', 'PartenairesController@create');
    Route::delete('partenaire/delete/{id}','PartenairesController@destroy');
    Route::post('partenaire/store', 'PartenairesController@store');
    Route::patch('partenaire/update/{id}', 'PartenairesController@update');
    //Compétences
    Route::get('competences', 'CompetencesController@index');
    Route::get('competence/edit/{id}', 'CompetencesController@show');
    Route::patch('competence/update/{id}', 'CompetencesController@update');
    //Storytelling
    Route::get('storytelling','StorytellingController@index');
    Route::get('storytelling/edit/{id}', 'StorytellingController@show');
    Route::put('storytelling/update/{id}', 'StorytellingController@update');
});

// Home
Route::get('/', 'HomeController@index');
Route::get('/actualites-cabinet/{slug}','HomeController@show');
Route::get('/actualites-cabinet','HomeController@indexArticles');


//Actus
Route::get('/actualites', 'ActusController@index');
Route::get('/actualites/{slug}','ActusController@show');
Route::get('/actualites/rubrique/{rubrique}', 'ActusController@indexByCategory');
Route::get('/actualites/article/{id}', 'ActusController@redirect');

//A propos
Route::get('/a-propos', function () {
    $remove_footer = "Disappear.";
    return view('about')->with('remove_footer',$remove_footer);
});
Route::get('/a-propos/datas', function()
{
    $result = App\AboutSlide::all();
    foreach ($result as $slide) {
        $slide->list_item;
    }
    return $result;
});

//FAQ
Route::get('/faq', function()
{
    $request = App\FaqListRubrique::lists('name');
    if($request->isEmpty()){
        return view('errors.faqNotFound');
    }
    return view('faq',compact('request'));
});
Route::get('/faq/list', function()
{
    $request = App\FaqListRubrique::lists('name');
    return compact('request');
});
Route::get('/faq/data', function()
{
    $request = App\FaqListRubrique::all();
    $result = [];
    $rubriques = [];
    foreach ($request as $element) {
        $result_arr = App\FaqListRubrique::where('name','=',$element->name)->first()->keywords;
        $rubriques_arr = $element->name;
        array_push($result,$result_arr);
        array_push($rubriques,$rubriques_arr);
    }
    return compact('rubriques','result');
});
Route::get('/faq/keywords/{rubrique}', function($rubrique)
{
    $articles = App\Faq::where('rubrique','like', '%'.$rubrique.'%')->with('keywords')->get();
    $res = $articles;
   
    return $res;
});

//Contact
Route::get('/contact', 'MailController@index');
Route::post('/contact/send', 'MailController@send');

//Chiffres utiles
Route::get('/chiffres-utiles','DigitController@index');
Route::get('/chiffres-utiles/rubrique/{rubrique}','DigitController@indexByCategory');
Route::get('/chiffres-utiles/{slug}','DigitController@show');
Route::get('/chiffres-utiles/article/{id}', 'DigitController@redirect');

//Sites utiles
Route::get('/sites-utiles', function () {
    $partenaires_shown = App\Partenaire::where('enabled','=',1)->get();
    return view('useful',compact('partenaires_shown'));
});

//Temoignages
Route::get('temoignages', 'TemoignagesController@all');
Route::get('temoignage/{slug}', 'TemoignagesController@view');


//JS route for appointments
Route::get('/collection/exceptions/appointments', function()
{
    return App\Appointment::orderBy('created_at','asc')->get();
});