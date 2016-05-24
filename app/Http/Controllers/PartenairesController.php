<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partenaire;
use App\Http\Requests;

class PartenairesController extends Controller
{
    public function show(Partenaire $id)
    {
        return view('admin.template.partenaire')->with('partenaire',$id);
    }

    public function index()
    {
        $partenaires = Partenaire::all();
        return view('admin.list.partenaires')->with('partenaires',$partenaires);
    }
}
