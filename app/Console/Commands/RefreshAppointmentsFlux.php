<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Facades\Storage;
use App\Appointment;

class RefreshAppointmentsFlux extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refreshxml:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is made the refresh the appointments database, and to parse data in mySQL, replacing some tables content.';

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
        Appointment::truncate();
        $directoryNamerdv = 'ec_tout_flux';
        $fileNamerdv = 'ec_flux_echeanciers.xml';
        $filerdv = Storage::disk('ftp')->get($directoryNamerdv . '/' . $fileNamerdv);
        Storage::disk('local')->put($fileNamerdv, $filerdv);
        $fileNamerdv = 'ec_flux_echeanciers';
        $filerdv = Storage::disk('ftp')->get($directoryNamerdv . '/' . $fileNamerdv . '.xml');
        $filerdv = str_replace('<gras>', '', $filerdv);
        $filerdv = str_replace('</gras>', '', $filerdv);
        $filerdv = str_replace('<exposant>', '', $filerdv);
        $filerdv = str_replace('</exposant>', '', $filerdv);
        Storage::disk('local')->put($fileNamerdv . '.xml', $filerdv);
        $xmlrdv = XmlParser::load(storage_path('app/' . $fileNamerdv . '.xml'));
        $dates = $xmlrdv->getContent();
        function datetimify($string)
        {
            $arr = preg_split('@[\s+　]@u', $string);
            $monthArr = ['Décembre', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre'];
            $monthIndex = array_search(ucwords(strtolower($arr[1])), $monthArr);
            $day = $arr[0];
            if (intval($monthIndex) > 0 && intval($monthIndex) < 10)
            {
                $monthIndex = '0' . $monthIndex;
                intval($monthIndex);
            }
            if (intval($monthIndex) == 0)
            {
                $monthIndex = '12';
                intval($monthIndex);
            }
            if (intval($day) > 0 && intval($day) < 10)
            {
                $day = '0' . $day;
                intval($day);
            }
            $datetime = $arr[2] . '-' . $monthIndex . '-' . $day;

            return $datetime;
        }

        foreach ($dates->article as $date)
        {
            $sections = $date->content->section;
            $created = $date->create_date->__toString();
            foreach ($sections as $section)
            {
                $data = [];
                $title = $section->section_title;
                $content = $section->section_content->texteparagraphe;
                $rdv = new Appointment();
                $first_caracter = substr($title, 0, 1);
                if ($title->__toString() !== 'Délai variable' && $title->__toString() !== '' && is_numeric($first_caracter))
                {
                    $formattedDate = preg_replace('@[\s+　]@u', ' ', $title->__toString());
                    $formattedDate = ucwords(strtolower($formattedDate));
                    $rdv->date = $formattedDate;
                    for ($i = 0; $i < count($content); $i++)
                    {
                        if ($i < 3)
                        {
                            //var_dump($content[$i]->__toString());
                            //var_dump(datetimify($title));
                            array_push($data, '<p>' . $content[$i]->__toString() . '</p>');
                        } else
                        {
                            break;
                        }
                    }
                    $rdv->content = implode(' ', $data);
                    $rdv->created_at = datetimify($title);
                    $rdv->rdv_id = $date->id->__toString();
                    $rdv->save();
                }
            }
        }
    }

}
