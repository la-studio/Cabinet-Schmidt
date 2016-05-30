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
    Route::get('/test', 'FluxController@store');
    Route::get('/chiffres-utiles', function () {
        return view('chiffres');
    });
    Route::get('/sites-utiles', function () {
        return view('useful');
    });

    Route::get('/logout','AuthController@logout');
    //Route::get('/login','AuthController@login');
});

Route::get('/', 'HomeController@index');
Route::get('/ftp', function () {
    $directoryName = 'ec_actu_tout_flux';
    $fileName = 'ec_flux_actualites.xml';
    $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName);
    //$file = FTP::connection()->readFile($directoryName.'/'.$fileName);
    Storage::disk('local')->put($fileName, $file);
    $fileName = 'ec_flux_actualites';

    $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName.'.xml');
    $file = str_replace('<lien', '<a', $file);
    $file = str_replace('</lien>', '</a>', $file);
    $file = str_replace('<exposant>', '', $file);
    $file = str_replace('</exposant>', '', $file);
    $file = str_replace('<retourligne/>', '', $file);
    Storage::disk('local')->put($fileName.'.xml', $file);

    $json = json_encode(Storage::disk('local')->get($fileName.'.xml'));
    Storage::disk('local')->put($fileName.'.json', $json);

    $xml = XmlParser::load(storage_path('app/'.$fileName.'.xml'));

    //bug d'affichage quand je display à la rache (en echo) : htmlentities fait l'affaire
    //mais de toute façon on sera pas confronté au pb avec blade et les bdd

    //$articles = simplexml_load_string(Storage::disk('local')->get($fileName.'.xml'));
    $articles = $xml->getContent();
    $titles = [];
    $medias = [];
    $paragraphes = [];
        foreach ($articles as $element) { // Works !! If i just echoout $element i get the entire object parsed.
            $title = $element->title->__toString();
            $author = $element->author->__toString();
            $date = $element->create_date->__toString();
            $media_attr = $element->media->attributes();
            $summary = $element->summary->__toString();
            //$link_attr = $element->content->section->section_content->reference->ref_lien;
            $tags = $element->tag;
            $contents = $element->content->section->section_content->texteparagraphe;
            $annotations = $element->content->section->section_content->annotation;
            $section_content = $element->content->section->section_content;
            $rubriques = [];
            $merged_content = [];
            $links = [];
            if(substr($element->create_date->__toString(),0,4)=='2016' && count($titles)<50) {
                foreach ($tags as $tag) {
                    $tag_attr = $tag->attributes();
                    if($tag_attr['type']=="rubrique") {
                        array_push($rubriques,$tag->__toString());
                    }
                }
                $rubriques = implode(' ',$rubriques); // Collapsing my array in one string separated by spaces.
                $article = new App\EchosArticle(); // Don't create object while looping on XML object
                if(isset($section_content->reference)) {
                    $reference = new App\Reference();
                    foreach($section_content->reference as $link) {
                        $reference->link = $link->ref_lien['href']->__toString();
                        $reference->label = $link->ref_lien->__toString();
                        //$reference->save();
                    }
                }
                if($media_attr['type']=="image") {
                    $article->image = 'http://photo.expert-infos.com/'.$element->media->__toString();
                }
                foreach ($section_content as $element) {
                    foreach($element as $sub) {
                        if($sub->getName()=="annotation" && $sub->getName()!=="reference") {
                        $ann_title = $sub->titreannotation->__toString();
                        $body = $sub->__toString();
                        $collapsing = $ann_title.$body;
                        str_replace('\n','',$collapsing);
                        array_push($merged_content, $collapsing);
                    } else if($sub->getName()!=="reference") {
                            array_push($merged_content, $sub->__toString());
                        }
                    }
                }
                $merged_content = implode(' ',$merged_content);
                $article->content = $merged_content;
                $article->title = $title;
                $article->date = $date;
                $article->summary = $summary;
                $article->auteur = $author;
                $article->rubrique = $rubriques;
                $article->save();
                if(isset($section_content->reference)) {
                    $article->references()->save($reference);
                }
                array_push($titles,$element->title->__toString());
            }
        }
});
