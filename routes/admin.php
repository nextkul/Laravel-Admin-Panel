<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
// Route::view('admin/register', 'admin.pages.auth.register')->name('admin.get.register');
// Route::view('admin/login', 'admin.pages.auth.login')->name('admin.get.login');
// Route::view('admin/forget-password', 'admin.pages.auth.forget-password')->name('admin.get.forgetPassword');
// Route::view('admin/recover-password', 'admin.pages.auth.recover-password')->name('admin.get.recoverPassword');
// Route::view('admin/dashboard', 'admin.welcome')->name('admin.get.dashboard');
Route::group(['namespace' => 'Admin','prefix' => 'admin','middleware' => ['auth']],function() {
    Route::get('dashboard', function () {
        return view('admin.welcome');
    })->name('admin.get.dashboard');




});
require __DIR__.'/auth.php';