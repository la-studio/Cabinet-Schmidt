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
        if(is_null($request->photo)){
            return back()->with('emptyFile', 'Yes');
        }
        $file = $request->photo;
        $destinationPath = public_path()."/images/partenaires";
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        $partenaire = new Partenaire($request->all());
        $partenaire->logo = "/images/partenaires/".$filename; // Filling this property manually
        $switch = $request->enabled; // This one aswell.
        if($switch==='on') {
            $partenaire->enabled = 1;
        } elseif($switch==null) {
            $partenaire->enabled = 0;
        }
        $partenaire->save();
        return redirect('/admin/partenaires');
    }
    public function update(Request $request, Partenaire $id)
    {
        $partenaire = $id;
        if(!is_null($request->photo)) {
            $file = $request->photo;
            $destinationPath = public_path().'/images/partenaires';
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $partenaire->logo = "/images/partenaires/".$filename;
            $switch = $request->enabled;
            if($switch==='on') {
                $partenaire->enabled = 1;
            } elseif($switch==null) {
                $partenaire->enabled = 0;
            }
            $partenaire->name = $request->name;
            $partenaire->link = $request->link;
            $partenaire->description = $request->description;
            $partenaire->save();
            return redirect('/admin/partenaires');
        } else {
            $switch = $request->enabled;
            if($switch==='on') {
                $partenaire->enabled = 1;
            } elseif($switch==null) {
                $partenaire->enabled = 0;
            }
            $partenaire->name = $request->name;
            $partenaire->link = $request->link;
            $partenaire->description = $request->description;
            $partenaire->save();
            return redirect('/admin/partenaires');
        }
    }
}
