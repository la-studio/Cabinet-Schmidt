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
        $file = $request->file;
        $destinationPath = public_path().'/images/partenaires';
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        $temoignage = new Temoignage($request->all());
        // $temoignage->content = $request->content;
        // $temoignage->person_job = $request->person_job;
        // $temoignage->person_identity = $request->person_identity;
        // $temoignage->logo = $destinationPath;
        $temoignage->save();
        return redirect('/admin/temoignages');
    }
    public function create()
    {
        return view('admin.new.temoignage');
    }
}
