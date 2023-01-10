<?php

use Illuminate\Support\Facades\Route;

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
    return view('admin.auth.login');
});


Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.',], function () {
          Route::view('login', 'admin.auth.login')->name('login');
          Route::post('authenticate', 'AuthController@login')->name('authenticate');
        Route::group(['middleware' => 'auth:admin'], function () {
          Route::get('logout', 'AuthController@logout')->name('logout');
            Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');
            Route::resource('user', 'UserController');
            Route::resource('teacher', 'TeacherController');

        });
    });
});
