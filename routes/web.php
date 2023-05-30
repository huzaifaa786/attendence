<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TimeSlotController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\JobController;
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
Route::get('admin/delete/student', [UserController::class, 'delete'])->name('delete/student');
Route::get('admin/delete/teacher', [TeacherController::class, 'delete'])->name('delete/teacher');
Route::post('admin/edit/student', [UserController::class, 'update'])->name('edit-student');
Route::get('admin/edit/teacher', [TeacherController::class, 'update'])->name('edit-teacher');

Route::get('admin/delete/course', [CourseController::class, 'delete'])->name('delete/course');
Route::get('admin/delete/lecture', [LectureController::class, 'delete'])->name('delete/lecture');
Route::post('admin/edit/course', [CourseController::class, 'update'])->name('edit-course');
Route::get('admin/edit/lecture', [LectureController::class, 'update'])->name('edit-lecture');
Route::post('admin/delete/timeslot', [TimeSlotController::class, 'delete'])->name('delete/timeslot');
Route::get('admin/edit/timeslot', [TimeSlotController::class, 'update'])->name('edit-timeslot');


Route::get('email/job', [JobController::class, 'sendMails']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.',], function () {
    Route::view('login', 'admin.auth.login')->name('login');
    Route::post('/finger/create', 'FingerPrintController@addFingerprintId')->name('finger.create');





    Route::post('authenticate', 'AuthController@login')->name('authenticate');
    Route::post('/finger/get', 'FingerPrintController@getFingerId')->name('finger.get');
    Route::post('/finger/handle', 'FingerPrintController@handleFingerID')->name('finger.get');
    Route::group(['middleware' => 'auth:admin'], function () {
      Route::get('logout', 'AuthController@logout')->name('logout');
      Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');
      Route::resource('user', 'UserController');
      Route::resource('attendance', 'FingerPrintController');
      Route::resource('teacher', 'TeacherController');
      Route::resource('course', 'CourseController');
      Route::resource('subject', 'SubjectController');
      Route::resource('timeslot', 'TimeSlotController');
      Route::resource('lecture', 'LectureController');
    }
    );
  }
  );

  Route::group(['prefix' => 'teacher', 'namespace' => 'Teacher', 'as' => 'teacher.',], function () {
    Route::group(['middleware' => 'auth:teacher'], function () {
      Route::view('dashboard', 'teacher.dashboard.index')->name('dashboard');
      Route::resource('content', 'ContentController');

    }
    );
  }
  );
});
