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
    // Admin routes.
    Route::auth();
    Route::group(['middleware'=> 'auth'],function() { // FIXME: Il faudrait merge ces deux groupes.
        Route::group(['prefix'=>'admin'],function(){
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
            Route::get('slider/create', 'SliderController@create');
            Route::delete('slider/delete/{id}','SliderController@destroy');
            Route::post('slider/store', 'SliderController@store');
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
            Route::get('competence/create', 'CompetencesController@create');
            Route::post('competence/store', 'CompetencesController@store');
            Route::patch('competence/update/{id}', 'CompetencesController@update');
        });
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

    Route::get('/ftp', function () {
        $directoryName = 'ec_actu_tout_flux';
        $fileName = 'ec_flux_actualites.xml';
        $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName);
        //$file = FTP::connection()->readFile($directoryName.'/'.$fileName);

        //dd($file);
        Storage::disk('local')->put($fileName, $file);
        $fileName = 'ec_flux_actualites';

        $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName.'.xml');
        $file = str_replace('<lien', '<a', $file);
        $file = str_replace('</lien>', '</a>', $file);

        Storage::disk('local')->put($fileName.'.xml', $file);

        $json = json_encode(Storage::disk('local')->get($fileName.'.xml'));
        Storage::disk('local')->put($fileName.'.json', $json);

        $xml = XmlParser::load(storage_path('app/'.$fileName.'.xml'));


        //bug d'affichage quand je display à la rache (en echo) : htmlentities fait l'affaire
        //mais de toute façon on sera pas confronté au pb avec blade et les bdd

        //$articles = simplexml_load_string(Storage::disk('local')->get($fileName.'.xml'));
        $articles = $xml->getContent();
        foreach ($articles as $article){
            echo $article->id;
            echo '<br>';
            echo $article->create_date;
            echo '<br>';
            echo $article->display_date;
            echo '<br>';
            echo $article->author;
            echo '<br>';
            echo $article->language;
            echo '<br>';
            echo $article->title;
            echo '<br>';
            echo $article->summary;
            echo '<br>';

            echo $article->content->section->section_content->asXML();

            // foreach($article->content->section->section_content->children() as $item){
            //     echo $item;
            //     echo '<br>';
            // }

            echo '<br>';

            // foreach($article->content->section->section_content->annotation as $item){
            //     echo $item->titreannotation;
            //     echo '<br>';
            //     echo $item;
            //     echo '<br>';
            // }


            // echo '<br>';
            // echo $article->tag;
            // echo '<br>';
            // echo $article->media;
            // echo '<br>';
            // echo $article->copyright;
            // echo '<br>';
            // echo '<br>';
            // echo '<br>';
        }
        dd($articles);
    });
    Route::get('/logout','AuthController@logout');
    //Route::get('/login','AuthController@login');
});

Route::get('/', 'HomeController@index');
