<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // get all category---------------------------------------------------
    public function allCat() {
        // 1. Query builder
        // $categories = DB::table('categories')
        //             ->join('users', 'categories.user_id', 'users.id')
        //             ->select('categories.*', 'users.name')
        //             ->latest()->paginate(5);
        // 2. Eloquent
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    // add category --------------------------------------------------
    public function addCat(Request $request) {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
            
        //  1. Eloquent // //
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id       = Auth::user()->id;
        // $category->save();

        // 2. Query builder // //  this doesnt show create_time
        $data = [];
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category inserted successfully');
    }

    // updating category --------------------------------------------
    public function edit($id) {
        // 1. Eloquent
        // $categories = Category::find($id);

        // 2. Query builder
        $categories = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id) {
        // 1. Eloquent
        // $category = Category::find($id);
        // $category->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);

        // 2. Query builder
        $data = [];
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);

        return redirect()->route('all.category')->with('success', 'Category name updated successfully');
    }

    // soft delete category --------------------------------------------
    public function softDelete($id) {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category moved to trash !');
    }

    // to restore from trash (soft delete)
    public function restore($id) {
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category restored to the list');
    }

    // to delete permanently from trash
    // public function pdelete($id) {
    //     $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
    //     return redirect()->back()->with('success', 'Category permanently deleted');
    // }
}
