<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    // Admin controlling site [sliders,]
    
    // all Sliders / backend view
    public function homeSlider() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index')->with('sliders', $sliders);
    }

    // new slider form <=================> ---------
    public function addSlider() {
        return view('admin.slider.create');
    }
    // add new slider action
    public function storeSlider(Request $request) {
        $validation = $request->validate([
            'title' => 'required|unique:sliders',
            'image' => 'required',
            'description' => 'required|min:5',
        ]);

        $slider_image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'. $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);

        // 1. Eloquent insertion
        // $slider = new Slider;
        // $slider->title = $request->title;
        // $slider->image = 'image/slider/'.$name_gen;
        // $slider->description = $request->description;
        // $slider->save();

        // 2. Query builder
        Slider::insert([
            'title' => $request->title,
            'image' => 'image/slider/'. $name_gen,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success', 'New slider inserted!');
    }

    // edit slider form -------------------------------------------
    public function edit($id) {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    // update slider action 
    public function update(Request $request, $id) {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $updateSlider = Slider::find($id);

        $old_image = $request->old_image;
        $new_image = $request->file('image');

        if($new_image != null) {
            $name_gen = hexdec(uniqid()).'.'. $new_image->getClientOriginalExtension();
            $location = 'image/slider/';
            $new_image->move($location, $name_gen);

            unlink($old_image);
            $updateSlider->title = $request->title;
            $updateSlider->image = $location.$name_gen;
            $updateSlider->description = $request->description;    
            $updateSlider->save();
        }else {
            $updateSlider->title = $request->title;
            $updateSlider->description = $request->description;    
            $updateSlider->save();
        }
        return Redirect('/slider/all')->with('success', 'Slider data updated ');
    }

    // delete slider action --------------------------------------------
    public function delete($id) {
        $deleteSlider = Slider::find($id);
        $old_image = $deleteSlider->image;
        unlink($old_image);
        $deleteSlider->delete();

        return Redirect('/slider/all')->with('success', 'Slider removed!');
    }
}
