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

// Route::get('/email', function()
// {
//     return view('email');
// });
    // Admin routes.
    Route::auth();
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
        //Storytelling
        Route::get('storytelling','StorytellingController@index');
        Route::get('storytelling/edit/{id}', 'StorytellingController@show');
        Route::put('storytelling/update/{id}', 'StorytellingController@update');
    });
    // Common nav.
    Route::get('/', 'HomeController@index');
    Route::get('/actualites', 'ActusController@index');
    Route::get('/actualites/page/{page}','ActusController@page');
    Route::get('/actualites/{slug}','ActusController@show');
    Route::get('/actualites/rubrique/{rubrique}', 'ActusController@indexByCategory');
    Route::get('/actualites/article/{id}', 'ActusController@redirect');
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
    Route::get('/faq', function()
    {
        $request = App\FaqListRubrique::lists('name');
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
    Route::get('/contact', 'MailController@index');
    Route::post('/contact/send', 'MailController@send');
    //Toolbox
    Route::get('/chiffres-utiles','DigitController@index');
    Route::get('/chiffres-utiles/{slug}','DigitController@show');
    Route::get('/chiffres-utiles/rubrique/{rubrique}','DigitController@indexByCategory');
    Route::get('/sites-utiles', function () {
        $partenaires_shown = App\Partenaire::where('enabled','=',1)->get();
        return view('useful',compact('partenaires_shown'));
    });

    Route::get('/logout','AuthController@logout');

Route::get('/', 'HomeController@index');

Route::get('/ftp', function () {
    Artisan::call('refreshxml');
});

Route::get('/collection/{collection}', function($collection)
{
    $result = DB::table($collection)->get();
    return $result;
});

Route::get('/collection/exceptions/appointements', function()
{
    return App\Appointment::orderBy('created_at','asc')->get();
});

Route::get('/getfaq', function()
{
    App\FaqReference::truncate();
    App\FaqKeyword::truncate();
    // App\FaqListKeyword::truncate();
    // App\FaqListRubrique::truncate();
    App\Faq::truncate();
    $directoryName = 'ec_tout_flux';
    $fileName = 'ec_flux_faq.xml';
    $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName);
    Storage::disk('local')->put($fileName, $file);
    $fileName = 'ec_flux_faq';
    $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName.'.xml');
    $file = str_replace('<lien', '<a', $file);
    $file = str_replace('</lien>', '</a>', $file);
    $file = str_replace('<exposant>', '', $file);
    $file = str_replace('</exposant>', '', $file);
    $file = str_replace('<retourligne/>', '', $file);
    $file = str_replace('<exposant>', '', $file);
    $file = str_replace('</exposant>', '', $file);
    Storage::disk('local')->put($fileName.'.xml', $file);
    $xml = XmlParser::load(storage_path('app/'.$fileName.'.xml'));
    $articles = $xml->getContent();
    $x = 0;
    foreach ($articles as $element) {
        $title = $element->title->__toString();
        $date = $element->create_date->__toString();
        $summary = $element->summary->__toString();
        $tags = $element->tag;
        $contents = $element->content->section->section_content->texteparagraphe;
        $annotations = $element->content->section->section_content->annotation;
        $section_content = $element->content->section->section_content;
        $rubriques = [];
        $keywords = [];
        $keyList = [];
        $rubriquesList = [];
        $merged_content = [];
        foreach ($tags as $tag) {
            $tag_attr = $tag->attributes();
            if($tag_attr['type']=="rubrique") {
                $rubrique_unique = new App\FaqListRubrique();
                $rubrique_unique->name = $tag->__toString();
                array_push($rubriques,$tag->__toString());
                array_push($rubriquesList,$rubrique_unique);
                // Essaie de créer tout ici sinon fais plus bas
            }
            if($tag_attr['type']=="keyword") {
                $keyword = new App\FaqKeyword();
                $keyword_unique = new App\FaqListKeyword();
                $keyword_unique->name = $tag->__toString();
                $keyword->keyword = $tag->__toString();
                array_push($keywords,$keyword);
                array_push($keyList,$keyword_unique);
            }
        }
        $rubriques = implode(' ',$rubriques); // Collapsing my array in one string separated by spaces.
        $article = new App\Faq(); // Don't create object while looping on XML object
        if(isset($section_content->reference)) {
            foreach($section_content->reference as $link) {
                $reference = new App\Faqreference();
                $reference->link = $link->ref_lien['href']->__toString();
                $reference->label = $link->ref_lien->__toString();
            }
        }
        foreach ($section_content as $element) {
            foreach($element as $sub) {
                if($sub->getName()=="annotation") {
                $ann_title = $sub->titreannotation->__toString();
                $body = $sub->__toString();
                $collapsing = $ann_title.$body;
                str_replace('\n','',$collapsing);
                array_push($merged_content, '<p>'.$collapsing.'<p>');
                } else if($sub->getName()!=="reference") {
                    if($sub->__toString()!=="") {
                        array_push($merged_content, '<p>'.$sub->__toString().'<p>');
                    }
                } //end last else if
            }
        }
        $merged_content = implode(' ',$merged_content);
        $article->reponse = $merged_content;
        $article->title = $title;
        $article->date = $date;
        $article->question = $summary;
        $article->rubrique = $rubriques;
        $article->save();
        if(isset($section_content->reference)) {
            $article->references()->save($reference);
        }
        foreach ($keywords as $keyword) {
            $article->keywords()->save($keyword);
        }
        $queryList = App\FaqListRubrique::lists('name')->toArray(); // new hook for sorting
        $queryListTwo = App\FaqListKeyword::lists('name')->toArray();
        foreach ($rubriquesList as $element) { // saving unique rubriques
            //$query = App\FaqListRubrique::where('name','=',$element->name);
            // $queryList = App\FaqListRubrique::lists('name')->toArray(); // original hook for storing.
            if(!in_array($element->name, $queryList)) {
                $element->save();
                array_push($queryList,$element->name);
                foreach ($keyList as $keyword) { // saving unique keywords binded to rubrique
                    //$queryListTwo = App\FaqListKeyword::lists('name')->toArray();// original hook for storing.
                    if(!in_array($keyword->name, $queryListTwo)) {
                        $keyword->save();
                        array_push($queryListTwo,$keyword->name);
                        $element->keywords()->attach($keyword->id);
                    } else {
                        $existing_key = App\FaqListKeyword::where('name','=',$keyword->name)->first();
                        $element->keywords()->attach($existing_key->id);
                    }
                }
            } else {
                  foreach ($keyList as $keyword) { // saving unique keywords binded to rubrique
                      //$queryListTwo = App\FaqListKeyword::lists('name')->toArray();
                      $query = App\FaqListRubrique::where('name','=',$element->name);
                      if(!in_array($keyword->name, $queryListTwo)) {
                          $keyword->save();
                          array_push($queryListTwo,$keyword->name);
                          $query->first()->keywords()->attach($keyword->id);
                      } else {
                            $existing_key = App\FaqListKeyword::where('name','=',$keyword->name)->first();
                            $res = DB::table('faq_list_keyword_faq_list_rubrique')->where('faq_list_keyword_id','=',$existing_key->id)->get();
                            foreach ($res as $obj) {
                                if($obj->faq_list_keyword_id!==$existing_key->id) {
                                    $query->first()->keywords()->attach($existing_key->id);
                                }
                            }
                       }
                  }
              }
        }
    }
});

Route::get('digitarticle', function() {
    App\Digitarticle::truncate();
    App\Digitreference::truncate();
    function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
        return 'n-a';
        }
        return $text;
    }

    $directoryName = 'ec_tout_flux';
    $fileName = 'ec_flux_chiffres.xml';
    $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName);
    Storage::disk('local')->put($fileName, $file);
    $fileName = 'ec_flux_chiffres';
    $file = Storage::disk('ftp')->get($directoryName.'/'.$fileName.'.xml');
    $file = str_replace('<lien', '<a', $file);
    $file = str_replace('</lien>', '</a>', $file);
    $file = str_replace('<exposant>', '', $file);
    $file = str_replace('</exposant>', '', $file);
    $file = str_replace('<retourligne/>', '', $file);
    $file = str_replace('<exposant>', '', $file);
    $file = str_replace('</exposant>', '', $file);
    Storage::disk('local')->put($fileName.'.xml', $file);
    $xml = XmlParser::load(storage_path('app/'.$fileName.'.xml'));

    $articles = $xml->getContent();
    $titles = [];
    $medias = [];
    $paragraphes = [];
    $tables = [];
    foreach ($articles as $element) {
        $title = $element->title->__toString();
        $author = $element->author->__toString();
        $date = $element->create_date->__toString();
        $media_attr = $element->media->attributes();
        $summary = $element->summary->__toString();
        $id = $element->id->__toString();
        $tags = $element->tag;
        $contents = $element->content->section->section_content->texteparagraphe;
        $annotations = $element->content->section->section_content->annotation;
        $section_content = $element->content->section->section_content;
        $rubriques = [];
        $merged_content = [];
        $current_table = '';
        $references = [];
        foreach ($tags as $tag) {
            $tag_attr = $tag->attributes();
            if($tag_attr['type']=="rubrique") {
                array_push($rubriques,$tag->__toString());
            }
        }
        $rubriques = implode(' ',$rubriques); // Collapsing my array in one string separated by spaces.
        $article = new App\Digitarticle(); // Don't create object while looping on XML object
        if(isset($section_content->reference)) {
            foreach($section_content->reference as $link) {
                $reference = new App\Digitreference();
                $reference->link = $link->ref_lien['href']->__toString();
                $reference->label = $link->ref_lien->__toString();
                array_push($references, $reference);
            }
        }
        if($media_attr['type']=="image") {
            $article->image = 'http://photo.expert-infos.com/'.$element->media->__toString();
        }
        foreach ($section_content as $element) {
            foreach($element as $sub) {
                if($sub->getName()=="annotation") {
                $ann_title = $sub->titreannotation->__toString();
                $body = $sub->__toString();
                $collapsing = $ann_title.$body;
                str_replace('\n','',$collapsing);
                array_push($merged_content, '<p>'.$collapsing.'</p>');
                } else if($sub->getName()!=="reference") {
                    if(isset($sub->table)) {
                        $current_table = '<table><tbody>';
                        foreach($sub->table->tbody->tr as $td) {
                            $current_table = $current_table.'<tr>';
                            foreach($td as $sub_td) {
                                $current_table = $current_table.'<td>'.$sub_td.'</td>';
                            }
                            $current_table = $current_table.'</tr>';
                        }
                        $current_table= $current_table.'</tbody></table>';
                    } else {
                        array_push($merged_content, '<p>'.$sub->__toString().'</p>');
                    }
                } //end last else if
            }
        }
        $merged_content = implode(' ',$merged_content);
        $article->content = $merged_content;
        $article->title = $title;
        $article->slug = slugify($title);
        $article->date = $date;
        $article->summary = $summary;
        $article->auteur = $author;
        $article->rubrique = $rubriques;
        $article->table_html = $current_table;
        $article->article_id = $id;
        $article->save();
        foreach ($references as $elem) {
            $article->references()->save($elem);
        }
        array_push($titles,$element->title->__toString());

    }
});

Route::get('rdv', function()
{
App\Appointment::truncate();
$directoryNamerdv = 'ec_tout_flux';
$fileNamerdv = 'ec_flux_echeanciers.xml';
$filerdv = Storage::disk('ftp')->get($directoryNamerdv.'/'.$fileNamerdv);
Storage::disk('local')->put($fileNamerdv, $filerdv);
$fileNamerdv = 'ec_flux_echeanciers';
$filerdv = Storage::disk('ftp')->get($directoryNamerdv.'/'.$fileNamerdv.'.xml');
$filerdv = str_replace('<gras>', '', $filerdv);
$filerdv = str_replace('</gras>', '', $filerdv);
$filerdv = str_replace('<exposant>', '', $filerdv);
$filerdv = str_replace('</exposant>', '', $filerdv);
Storage::disk('local')->put($fileNamerdv.'.xml', $filerdv);
$xmlrdv = XmlParser::load(storage_path('app/'.$fileNamerdv.'.xml'));
$dates = $xmlrdv->getContent();
function datetimify($string) {
    $arr = preg_split('/\s+/',$string);
    $monthArr = ['Décembre','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre'];
    $monthIndex = array_search($arr[1], $monthArr);
    $day = $arr[0];
    if(intval($monthIndex) > 0 && intval($monthIndex) < 10 ) {
        $monthIndex = '0'.$monthIndex;
        intval($monthIndex);
    }
    if(intval($day) > 0 && intval($day) < 10 ) {
        $day = '0'.$day;
        intval($day);
    }
    $datetime = $arr[2].'-'.$monthIndex.'-'.$day;
    return $datetime;
}
foreach($dates->article as $date) {
    $sections = $date->content->section;
    $created = $date->create_date->__toString();
    foreach($sections as $section) {
        $data = [];
        $title = $section->section_title;
        $content = $section->section_content->texteparagraphe;
        $rdv = new App\Appointment();
        $first_caracter = substr($title,0,1);
        if($title->__toString()!=='Délai variable' && $title->__toString()!=='' && is_numeric($first_caracter)) {
            $rdv->date = $title->__toString();
            for($i=0; $i < count($content); $i++) {
                if($i<3) {
                    //var_dump($content[$i]->__toString());
                    var_dump(datetimify($title));
                    array_push($data,'<p>'.$content[$i]->__toString().'</p>');
                } else {
                    break;
                }
            }
            $rdv->content = implode(' ',$data);
            $rdv->created_at = datetimify($title);
            $rdv->save();
        }
    }
}
});
