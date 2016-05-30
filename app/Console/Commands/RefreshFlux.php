<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Echosarticle;
use App\Reference;
use Log;

class RefreshFlux extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshxml';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is made the refresh the xml database weekly, and to parse data in mySQL, replacing some tables content.';

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
                    $article = new EchosArticle(); // Don't create object while looping on XML object
                    if(isset($section_content->reference)) {
                        $reference = new Reference();
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
            Log::info('Everything is ok');
    }
}
