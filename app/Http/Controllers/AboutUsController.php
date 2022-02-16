<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    // get data from database ---------------------------------------
    public function getAbout() {
        $aboutUs = HomeAbout::latest()->get();
        return view('admin.aboutus.index', compact('aboutUs'));
    }

    // add new about us ---------------------------------------
    public function addAbout() {
        return view('admin.aboutus.create');
    }

    public function storeAbout(Request $request) {
        $validation = $request->validate([
            'title' => 'required|min:2|unique:home_abouts',
            'short_description' => 'required',
            'long_description' => 'required'
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('home.about')->with('success', 'New about us created');
    }

    // == // ==== // == == // EDIT AND UPDATE // == == // ==== // ==
    public function edit($id) {
        $edit = HomeAbout::find($id);
        return view('admin.aboutus.edit', compact('edit'));
    }

    public function update(Request $request,$id) {
        $update = HomeAbout::find($id);
        $validation = $request->validate([
            'title' => 'required|min:2',
            'short_description' => 'required',
            'long_description' => 'required'
        ]);

        $update->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('home.about')->with('success', 'About us has been updated');
    }

    // == // ==== // == == // DELETE ABOUT US // ==== // == == // ==== // ==
    public function delete($id) {
        $delete = HomeAbout::find($id)->delete();
        return redirect()->route('home.about')->with('success', 'About us deleted!');
    }
}
