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
    Route::post('/finger/create','FingerPrintController@addFingerprintId')->name('finger.create');

    Route::post('authenticate', 'AuthController@login')->name('authenticate');
    Route::post('/finger/get','FingerPrintController@getFingerId')->name('finger.get');
    Route::post('/finger/handle','FingerPrintController@handleFingerID')->name('finger.get');
    Route::group(['middleware' => 'auth:admin'], function () {
      Route::get('logout', 'AuthController@logout')->name('logout');
      Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');
      Route::resource('user', 'UserController');
      Route::resource('teacher', 'TeacherController');
      Route::resource('course', 'CourseController');
      Route::resource('subject', 'SubjectController');
      Route::resource('timeslot', 'TimeSlotController');
      Route::resource('lecture', 'LectureController');
    });
  });

    Route::group(['prefix' => 'teacher', 'namespace' => 'Teacher', 'as' => 'teacher.',], function () {
      Route::group(['middleware' => 'auth:teacher'], function () {
        Route::view('dashboard', 'teacher.dashboard.index')->name('dashboard');
      Route::resource('content', 'ContentController');

    });
  });
});
