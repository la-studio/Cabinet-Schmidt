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
        if(is_null($request->logo) || is_null($request->photo)){
            return back()->with('emptyFile', 'Yes');
        }
        $file = $request->logo;
        $destinationPath = public_path()."/images/partenaires";
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        $file2 = $request->photo;
        $destinationPath2 = public_path()."/images/partenaires";
        $filename2        = $file2->getClientOriginalName();
        $uploadSuccess2   = $file2->move($destinationPath2, $filename2);
        $temoignage = new Temoignage($request->all());
        $temoignage->slug = str_slug($request->person_identity);
        $temoignage->logo = "/images/partenaires/".$filename; // Filling this property manually
        $temoignage->photo = "/images/partenaires/".$filename2; // Filling this property manually
        $temoignage->save();
        return redirect('/admin/temoignages');
    }
    public function create()
    {
        return view('admin.new.temoignage');
    }
    public function update(Request $request, $id)
    {
        $temoignage = Temoignage::find($id);
        if(!is_null($request->logo)) {
            $file = $request->logo;
            $destinationPath = public_path().'/images/partenaires';
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $temoignage->logo = "/images/partenaires/".$filename;
        }
        if(!is_null($request->photo)) {
            $file2 = $request->photo;
            $destinationPath2 = public_path()."/images/partenaires";
            $filename2        = $file2->getClientOriginalName();
            $uploadSuccess2   = $file2->move($destinationPath2, $filename2);
            $temoignage->photo = "/images/partenaires/".$filename2;
        }
        $temoignage->content = $request->content;
        $temoignage->description = $request->description;
        $temoignage->person_job = $request->person_job;
        $temoignage->person_identity = $request->person_identity;
        $temoignage->slug = str_slug($request->person_identity);
        $temoignage->save();
        return redirect('/admin/temoignages');
    }
    public function view($slug)
    {
        $temoignage = Temoignage::where('slug', "=", $slug)->first();
        if(is_null($temoignage)){
            return abort(404);
        }
        return view('temoignage', compact('temoignage'));
    }
    public function all()
    {
        $temoignages = Temoignage::all();
        return view('temoignages')->with('temoignages',$temoignages);
    }
}
