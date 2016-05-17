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

Route::get('/', function () {
    return view('home');
});

Route::get('/test', 'TemoignagesController@findAll');

Route::get('/actus', function () {
    return view('actusgallery');
});

Route::get('/about', function () {
    $remove_footer = "Disappear.";
    return view('about')->with('remove_footer',$remove_footer);
});

Route::get('/contact', function () {
    $check = "i'm here to check something.";
    return view('contact')->with('check',$check);
});

Route::get('/chiffres-utiles', function () {
    return view('chiffres');
});

Route::get('/sites-utiles', function () {
    return view('useful');
});
