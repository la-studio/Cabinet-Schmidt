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
}
