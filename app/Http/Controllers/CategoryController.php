<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // get all category
    public function allCat() {
        // $categories = Category::latest()->get();
        $categories = DB::table('categories')->latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
    }

    // add category
    public function addCat(Request $request) {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        
        // Category::insert([
            //     'category_name' => $request->category_name,
            //     'user_id'       => Auth::user()->id,
            //     'created_at'    => Carbon::now(),
            // ]);
            
        // <-- two ways insert into database -->

        //  1. Eloquent // //
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id       = Auth::user()->id;
        // $category->save();

        // 2. Query builder // //
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category inserted successfully');
    }

}
