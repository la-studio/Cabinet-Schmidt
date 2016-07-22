<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Http\Requests;

class SliderController extends Controller
{
    public function show(Slider $id)
    {
        return view('admin.templates.slider')->with('slide',$id);
    }

    public function index()
    {
        $slides = Slider::all();
        return view('admin.list.slider')->with('slider',$slides);
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        if(!is_null($request->photo)) {
            $file = $request->photo;
            $destinationPath = public_path().'/images/slider';
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $slider->cover = "/images/slider/".$filename;
            $slider->description = $request->description;
            $slider->title = $request->title;
            $slider->button_name = $request->button_name;
            $slider->button_link = $request->button_link;
            $slider->save();
            return redirect('/admin/slider');
        } else {
            $slider->update($request->all());
            return redirect('/admin/slider');
        }
    }
}
