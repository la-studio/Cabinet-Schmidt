<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competence;
use App\Http\Requests;

class CompetencesController extends Controller
{
    public function index()
    {
        $competences = Competence::all();
        return view('admin.list.competences',compact('competences'));
    }
    public function show(Competence $id)
    {
        return view('admin.templates.competence')->with('competence', $id);
    }
    public function update(Request $request, Competence $id)
    {
        $id->update($request->all());
        return redirect('/admin/competences');
    }
    public function create()
    {
        return view('admin.new.competence');
    }
    public function store(Request $request)
    {
        $competence = new Competence($request->all());
        $competence->save();
        return back();
    }
}
