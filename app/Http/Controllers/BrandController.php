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
        $img_name = $name_gen.'.'.$img_ext;

        $brand_image->move('image/brand', $img_name);

        Brand::insert([
            'brand_name' =>$request->input('brand_name'),
            'brand_image' => 'image/brand/'.$img_name,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'New Brand created');
    }
}
