<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Models\Multipic;
use Carbon\Carbon;
use Image;

class BrandController extends Controller
{
    // for logged in authentification
    public function __construct()
    {
        $this->middleware('auth');       
    }
    // Get all brand
    public function allBrand() {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    // add new brand
    public function storeBrand(BrandRequest $request) {
        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $location = 'image/brand/';
        // $img_name = $name_gen.'.'.$img_ext;
        // $brand_image->move($location, $img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $location = 'image/brand/';

        Image::make($brand_image)->resize(300, 200)->save($location . $name_gen);

        Brand::insert([
            'brand_name' =>$request->input('brand_name'),
            'brand_image' => $location.$name_gen,
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

    // soft delete brand
    public function delete($id) {
        $data      = Brand::find($id);
        // image unlink to remove from folder image/brand
        $old_image = $data->brand_image;
        unlink($old_image);

        $data->delete();
        return Redirect()->back()->with('success', 'Brand moved to trash!');
    }

    // multipic  -------------------------------------------------
    public function multiPic() {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }

    // upload images
    public function storeImage(Request $request) {
        $validation = $request->validate([
            'image' => 'required',
        ]);

        $images = $request->file('image');

        // loop each image and upload it to database
        foreach($images as $image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('image/multi/'. $name_gen);
    
            Multipic::insert([
                'image' => 'image/multi/'.$name_gen,
                'created_at' => Carbon::now(),
            ]);
        }
        return Redirect()->back()->with('success', 'Image uploaded successfully');
    }

}
