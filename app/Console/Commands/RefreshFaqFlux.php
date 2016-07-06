<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Faq;
use App\FaqReference;
use App\FaqKeyword;
use App\FaqListKeyword;
use App\FaqListRubrique;

class RefreshFaqFlux extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshxml:faq';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is made the refresh the xml database, and to parse data in mySQL, replacing some tables content.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        FaqReference::truncate();
        FaqKeyword::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FaqListKeyword::truncate();
        FaqListRubrique::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Faq::truncate();
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
                    $rubrique_unique = new FaqListRubrique();
                    $rubrique_unique->name = $tag->__toString();
                    array_push($rubriques,$tag->__toString());
                    array_push($rubriquesList,$rubrique_unique);
                }
                if($tag_attr['type']=="keyword") {
                    $keyword = new FaqKeyword();
                    $keyword_unique = new FaqListKeyword();
                    $keyword_unique->name = $tag->__toString();
                    $keyword->keyword = $tag->__toString();
                    array_push($keywords,$keyword);
                    array_push($keyList,$keyword_unique);
                }
            }
            $rubriques = implode(' ',$rubriques); // Collapsing my array in one string separated by spaces.
            $article = new Faq(); // Don't create object while looping on XML object
            if(isset($section_content->reference)) {
                foreach($section_content->reference as $link) {
                    $reference = new FaqReference();
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
            $queryList = FaqListRubrique::lists('name')->toArray(); // new hook for sorting
            $queryListTwo = FaqListKeyword::lists('name')->toArray();
            foreach ($rubriquesList as $element) { // saving unique rubriques
                if(!in_array($element->name, $queryList)) {
                    $element->save();
                    array_push($queryList,$element->name);
                    foreach ($keyList as $keyword) { // saving unique keywords binded to rubrique
                        if(!in_array($keyword->name, $queryListTwo)) {
                            $keyword->save();
                            array_push($queryListTwo,$keyword->name);
                        } else {
                            $existing_key = FaqListKeyword::where('name','=',$keyword->name)->first();
                        }
                    }
                } else {
                      foreach ($keyList as $keyword) { // saving unique keywords binded to rubrique
                          $query = FaqListRubrique::where('name','=',$element->name);
                          if(!in_array($keyword->name, $queryListTwo)) {
                              $keyword->save();
                              array_push($queryListTwo,$keyword->name);
                          }
                      }
                  }
            }
        }
        //Associate keywords id and rubrique id to the pivot Table
        $rubriques = FaqListRubrique::all();
        $keywords = FaqListKeyword::all();
        DB::table('faq_list_rubriques_keywords')->truncate();
        
        foreach($rubriques as $rubrique){
            $rubriqueId = $rubrique->id;
            $rubriqueKeywords[$rubrique->name] = [];
            $allArticlesRelated = Faq::where('rubrique','like', '%'.$rubrique->name.'%')->with('keywords')->get();
            foreach ($allArticlesRelated as $article) {
                foreach ($article->keywords as $keyword) {
                    //ajouter l'id de la rubrique et du keyword dans un tableau
                    $keywordId = FaqListKeyword::where('name', '=', $keyword->keyword)->first()->id;
                    if(!in_array($keywordId, $rubriqueKeywords[$rubrique->name])){
                        array_push($rubriqueKeywords[$rubrique->name], $keywordId);
                        $rubrique->keywords()->attach($keywordId);
                    }
                }
            }
        }
    }
}
