<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use App\Models\User;
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

// category controler
Route::get('/category/all', [CategoryController::class, 'allCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');

// with jetstream/livewire
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $userData = User::all();
    $userData = DB::table('users')->get();
    return view('dashboard', compact('userData'));
})->name('dashboard');
