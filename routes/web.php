<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
   
   Route::middleware(['admin_redirect_if_tauthenticated'])->group(function(){
     Route::match(['get','post'],'login','AdminController@login')->name('admin.login');
     Route::match(['get','post'],'forgot-password','AdminController@forgotPassword')->name('admin.forgot_password');
     Route::match(['get','post'],'reset-password/{token}','AdminController@resetPassword')->name('admin.reset_password');
   });
   
   Route::middleware(['admin'])->group(function(){
     Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
     Route::get('slider','AdminController@slider')->name('admin.slider');
   });
});