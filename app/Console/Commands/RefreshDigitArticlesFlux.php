<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\Storage;
use App\Digitarticle;
use App\Digitreference;

class RefreshDigitArticlesFlux extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshxml:digit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Digitarticle::truncate();
        Digitreference::truncate();
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
        $file = str_replace('<lien', '<a', $file);
        $file = str_replace('</lien>', '</a>', $file);
        $file = str_replace('<exposant>', '', $file);
        $file = str_replace('</exposant>', '', $file);
        $file = str_replace('<retourligne/>', '', $file);
        $file = str_replace('<exposant>', '', $file);
        $file = str_replace('</exposant>', '', $file);
        Storage::disk('local')->put($fileName, $file);
        $xml = XmlParser::load(storage_path('app/'.$fileName));

        $articles = $xml->getContent();
        $titles = [];
        $medias = [];
        $paragraphes = [];
        $tables = [];
        foreach ($articles as $element) {
            $title = $element->title->__toString();
            $author = $element->author->__toString();
            $date = $element->display_date->__toString();
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
            $article = new Digitarticle(); // Don't create object while looping on XML object
            if(isset($section_content->reference)) {
                foreach($section_content->reference as $link) {
                    $reference = new Digitreference();
                    $reference->link = $link->ref_lien['href']->__toString();
                    $reference->label = $link->ref_lien->__toString();
                    array_push($references, $reference);
                }
            }
            if($media_attr['type']=="image") {
                $article->image = 'https://photo.expert-infos.com/'.$element->media->__toString();
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
    }
}
