<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    // Get all brand
    public function allBrand() {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    // add new brand
    public function storeBrand(BrandRequest $request) {
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $location = 'image/brand/';
        $img_name = $name_gen.'.'.$img_ext;

        $brand_image->move($location, $img_name);

        Brand::insert([
            'brand_name' =>$request->input('brand_name'),
            'brand_image' => $location.$img_name,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'New Brand created');
    }

    // edit brand
    public function edit($id) {
        // 1. Eloquent
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand', $brand));
    }

    // update brand
    public function update(Request $request, $id) {
        // validation instead of using BrandRequest
        $validation = $request->validate([
            'brand_name' => 'required|min:4',
        ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if($brand_image != null) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $location = 'image/brand/';
            $img_name = $name_gen.'.'.$img_ext;
            $brand_image->move($location, $img_name);
    
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $location.$img_name,
                'updated_at' => Carbon::now(),
            ]);
        }else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now(),
            ]);
        }

        return Redirect('/brand/all')->with('success', 'Brand updated');
    }
}
