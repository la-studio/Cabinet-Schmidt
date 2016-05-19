<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temoignage;
use DB;
use App\Http\Requests;

class TemoignagesController extends Controller
{
    public function findAll() {
        $temoignages = Temoignage::all();
        return $temoignages;
    }
}
