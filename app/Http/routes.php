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
Route::group(['middleware' => ['web']], function () {

    // Admin routes. A mettre sous middleware avec un suffixe.
    Route::group(['prefix'=>'admin'],function(){
        //Articles
        Route::get('articles','ArticlesController@index');
        Route::get('article/edit/{id}', 'ArticlesController@show');
        Route::get('article/create', 'ArticlesController@create');
        Route::post('article/store', 'ArticlesController@store');
        Route::patch('article/update/{id}', 'ArticlesController@update');
        Route::delete('article/delete/{id}','ArticlesController@destroy');
        // Temoignages
        Route::get('temoignages', 'TemoignagesController@index');
        Route::get('temoignage/edit/{id}', 'TemoignagesController@show');
        Route::delete('temoignage/delete/{id}','TemoignagesController@destroy');
        Route::post('temoignage/store', 'TemoignagesController@store');
        Route::patch('temoignage/update/{id}', 'TemoignagesController@update');
        Route::get('temoignage/create', 'TemoignagesController@create');
        //Slider
        Route::get('slider', 'SliderController@index');
        Route::get('slider/{id}', 'SliderController@show');

        //Partenaires
        Route::get('partenaires', 'PartenairesController@index');
        Route::get('partenaire/{id}', 'PartenairesController@show');
    });

    // Common nav.
    Route::get('/', 'HomeController@index');
    Route::get('/actus', 'ActusController@index');
    Route::get('/about', function () {
        $remove_footer = "Disappear.";
        return view('about')->with('remove_footer',$remove_footer);
    });
    Route::get('/contact', function () {
        $check = "i'm here to check something.";
        return view('contact')->with('check',$check);
    });

    //Toolbox
    Route::get('/chiffres-utiles', function () {
        return view('chiffres');
    });
    Route::get('/sites-utiles', function () {
        return view('useful');
    });
});
