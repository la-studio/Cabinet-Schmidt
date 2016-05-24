<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Http\Requests;

class SliderController extends Controller
{
    public function show(Slider $id)
    {
        return view('admin.template.slider')->with('slider',$id);
    }

    public function index()
    {
        $slides = Slider::all();
        return view('admin.list.slider')->with('slider',$slides);
    }
    public function create()
    {
        return view('admin.new.slide');
    }
    public function store(Request $request, Slider $id)
    {
        $file = $request->cover;
        $destinationPath = public_path()."/images/slider";
        $filename        = $file->getClientOriginalName();
        $uploadSuccess   = $file->move($destinationPath, $filename);
        $id = new Slider($request->all());
        $id->cover = "/images/slider/".$filename; // Filling this property manually
        $id->save();
        return redirect('/admin/slider');
    }
}
