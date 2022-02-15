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
    
    // Slider section backend view
    public function homeSlider() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index')->with('sliders', $sliders);
    }

    // new slider form <=================> ---------
    public function addSlider() {
        return view('admin.slider.create');
    }
    // add slider
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
}
