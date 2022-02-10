<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    echo "this is homepage";
});

Route::get('/about', function() {
    echo "this is about page";
})->middleware('check');

Route::get('/contact', [ContactController::class, 'contactView'])->name('contact');

// category controler -----------------------------------------
Route::get('/category/all', [CategoryController::class, 'allCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');

// edit cat
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);

// Delete cat & restore
Route::get('/category/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('category/pdelete/{id}', [CategoryController::class, 'pdelete']);


// Brand Route ---------------------------
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');






// with jetstream/livewire
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $userData = User::all();
    $userData = DB::table('users')->get();
    return view('dashboard', compact('userData'));
})->name('dashboard');
