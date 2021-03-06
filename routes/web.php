<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPassword;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Models\Brand;
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
    $brands = Brand::all();
    $about = DB::table('home_abouts')->first();
    $portfolios = DB::table('multipics')->get();
    return view('home', compact('brands', 'about', 'portfolios'));
});

Route::get('/home', function() {
    echo "this is homepage";
});

Route::get('/about', function() {
    echo "this is about page";
})->middleware('check');


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


// Brand Route -------------------------------------------------------------
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
// posting new brand
Route::post('/brand/add', [BrandController::class, 'storeBrand'])->name('store.brand');
// edit brand
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
// delete brand
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

// Multipic Route -------------------------------------------------------------
Route::get('/multi/image', [BrandController::class, 'multiPic'] )->name('multi.image');
// add pictures
Route::post('/multipic/add', [BrandController::class, 'storeImage'])->name('store.image');

// Admin routes ------------<===================> -------------------------
// == SLIDERS SECTION == //
Route::get('slider/all', [HomeController::class, 'homeSlider'])->name('home.slider');
Route::get('slider/add/form', [HomeController::class, 'addSlider'])->name('add.slider');
Route::post('slider/add/action', [HomeController::class, 'storeSlider'])->name('store.slider');
Route::get('slider/edit/{id}', [HomeController::class, 'edit']);
Route::post('slider/update/{id}', [HomeController::class, 'update']);
Route::get('slider/delete/{id}', [HomeController::class, 'delete']);

// == ABOUT US SECTION == //
Route::get('home/about', [AboutUsController::class, 'getAbout'])->name('home.about');
Route::get('home/about/add/form', [AboutUsController::class, 'addAbout'])->name('add.about');
Route::post('home/about/add/action', [AboutUsController::class, 'storeAbout'])->name('store.about');
Route::get('home/about/edit/{id}', [AboutUsController::class, 'edit']);
Route::post('home/about/update/{id}', [AboutUsController::class, 'update']);
Route::get('home/about/delete/{id}', [AboutUsController::class, 'delete']);

// == CONTACT SECTION == //
Route::get('/admin/contact', [ContactController::class, 'adminContact'])->name('admin.contact');
Route::get('/admin/contact/add/form', [ContactController::class, 'addContact'])->name('add.contact');
Route::post('/admin/contact/add/action', [ContactController::class, 'storeContact'])->name('store.contact');
Route::get('/admin/contact/edit/{id}', [ContactController::class, 'edit']);
Route::post('/admin/contact/update/{id}', [ContactController::class, 'update']);
Route::get('/admin/contact/delete/{id}', [ContactController::class, 'delete']);
Route::get('/admin/contact/message', [ContactController::class, 'adminMessage'])->name('admin.contact.message');

// == CHANGE ADMIN PASSWORD == //
Route::get('/admin/change/password', [AdminPassword::class, 'changePassword'])->name('change.password');
Route::post('/admin/update/password', [AdminPassword::class, 'updatePassword'])->name('password.update');


// FRONT PAGE ROUTES ------------<===================> -------------------------
Route::get('/home/portfolio', [PortfolioController::class, 'getPortfolio'])->name('portfolio');
Route::get('/home/contact', [ContactController::class, 'getContact'])->name('contact');
Route::post('/home/contact/submit', [ContactController::class, 'storeMessage'])->name('contact.form');












// with jetstream/livewire --------------------------------------------
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $userData = User::all();
    $userData = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

// email verification when signing up ------------------------------------
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// admin logout ---------------------------------------------
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
