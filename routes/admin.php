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
    
    /* -------------------User----------- */
    Route::prefix('user')->group(function () {
        Route::get('/', 'User\UserController@index')->name('user.get.index');
        Route::post('create', 'User\UserController@create')->name('user.get.create');
        Route::get('show/{id}', 'User\UserController@show')->name('user.get.show');
        Route::get('delete/{id}', 'User\UserController@destroy')->name('user.get.delete');
        Route::get('active/{id}', 'User\UserController@activeUser')->name('user.get.active');
        Route::get('inactive/{id}', 'User\UserController@deactiveUser')->name('user.get.inactive');
        Route::get('edit/{id}', 'User\UserController@edit')->name('user.get.edit');
        Route::post('update', 'User\UserController@update')->name('user.post.update');
        //Unverified Users
        Route::get('unverified-users', 'User\UserController@getUsers')->name('user.get.unverified-users'); 
        Route::get('verified/{id}', 'User\UserController@verifiedUser')->name('user.get.verified');
        Route::get('unverified/{id}', 'User\UserController@unverifiedUser')->name('user.get.unverified');
    });



});
require __DIR__.'/auth.php';