<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partenaire;
use App\Http\Requests;

class PartenairesController extends Controller
{
    public function show(Partenaire $id)
    {
        return view('admin.templates.partenaire')->with('partenaire',$id);
    }

    public function index()
    {
        $partenaires = Partenaire::all();
        return view('admin.list.partenaires')->with('partenaires',$partenaires);
    }
    public function create()
    {
        return view('admin.new.partenaire');
    }
    public function destroy(Partenaire $id)
    {
        
        $id->delete();
        return redirect('/admin/partenaires');
    }
    public function store(Request $request)
    {
        $file = $request->photo;
        $destinationPath = public_path()."/images/partenaires";
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        $temoignage = new Partenaire($request->all());
        $temoignage->logo = "/images/partenaires/".$filename; // Filling this property manually
        $temoignage->save();
        return redirect('/admin/partenaires');
    }
}
