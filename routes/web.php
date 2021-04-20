<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;

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
})->name('welcome');

Auth::routes();

Route::get('/home',function () {
    return view('home');
})->name('home')->middleware('auth');




Route::group(['as'=>'admin.','middleware'=>['auth','admin']],function(){
    Route::group(['prefix'=>'admin'],function(){
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
    });
    Route::get('logout', [LoginController::class,'logout'])->name('logout');
});
