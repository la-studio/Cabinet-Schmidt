<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutSlide;
use App\AboutList;
use App\Http\Requests;

class StorytellingController extends Controller
{
    public function index()
    {
        $stories = AboutSlide::all();
        return view('admin.list.storytelling',compact('stories'));
    }

    public function update(Request $request, AboutSlide $id)
    {
        $slide = $id;
        $list = $request->item;
        AboutList::where('about_slide_id','=',$slide->id)->delete();
        foreach ($list as $item) {
            $newItem = new AboutList();
            $newItem->name = $item;
            $slide->list_item()->save($newItem);
        }
        if(!is_null($request->photo)) {
            $file = $request->photo;
            $destinationPath = public_path().'/images';
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            $slide->cover = "/images/".$filename;
            $slide->title = $request->title;
            $slide->summary = $request->summary;
            $slide->save();
            return redirect('/admin/storytelling');
        } else {
            $slide->update($request->all());
            return redirect('/admin/storytelling');
        }
    }

    public function show(AboutSlide $id)
    {
        return view('admin.templates.storytelling')->with('slide',$id);
    }

    public function destroy(AboutSlide $id)
    {
        $id->delete();
        return redirect('/admin/storytelling');
    }
}
