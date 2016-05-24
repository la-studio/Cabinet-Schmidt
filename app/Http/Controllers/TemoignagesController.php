<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temoignage;
use DB;
use App\Http\Requests;

class TemoignagesController extends Controller
{
    public function show(Temoignage $id)
    {
        return view('admin.templates.temoignage')->with('temoignage',$id);
    }

    public function index()
    {
        $temoignages = Temoignage::all();
        return view('admin.list.temoignages')->with('temoignages',$temoignages);
    }
    public function destroy(Temoignage $id)
    {
        $id->delete();
        return redirect('/admin/temoignages');
    }
    public function store(Request $request)
    {
        $file = $request->photo;
        $destinationPath = public_path()."/images/partenaires";
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        $temoignage = new Temoignage($request->all());
        $temoignage->logo = "/images/partenaires/".$filename; // Filling this property manually
        $temoignage->save();
        return redirect('/admin/temoignages');
    }
    public function create()
    {
        return view('admin.new.temoignage');
    }
    public function update(Request $request, Temoignage $id)
    {
        if(!is_null($request->photo)) {
            $file = $request->photo;
            $destinationPath = public_path().'/images/partenaires';
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $id->logo = "/images/partenaires/".$filename;
            $id->content = $request->content;
            $id->person_job = $request->person_job;
            $id->person_identity = $request->person_identity;
            $id->update();
            return redirect('/admin/temoignages');
        } else {
            $id->update($request->all());
            return redirect('/admin/temoignages');
        }
    }
}
