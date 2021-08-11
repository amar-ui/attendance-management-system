<?php

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

use App\Http\Controllers\HomeController;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware'  =>  'auth'], function () {
    Route::resource('subject', 'SubjectController');
    Route::resource('department', 'DepartmentController');
    Route::resource('course', 'CourseController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('student', 'StudentController');
    Route::resource('attendance', 'AttendanceController');

    Route::get('close/create', ['as' => 'close.create', 'uses' => 'AttendanceCloseController@create']);
    Route::post('close/store', ['as' => 'close.store', 'uses' => 'AttendanceCloseController@store']);
    Route::get('close/studentlist/{id}', ['as' => 'close.studentList', 'uses' => 'AttendanceCloseController@studentList']);
    Route::get('close/publish/{id}', ['as' => 'close.publish', 'uses' => 'AttendanceCloseController@publish']);
    Route::get('close/export/{id}', ['as' => 'close.export', 'uses' => 'AttendanceCloseController@exportList']);

    Route::get('teacher/profile/{id}', ['as' => 'teacher.profile', 'uses' => 'TeacherController@profile']);

    // Route::resource('close', 'AttendanceCloseController');
    Route::post('password/reset', ['as' => 'reset.password', 'uses' => 'HomeController@resetPassword']);

    Route::get('report/student-list', ['as' => 'report.student-list', 'uses' => 'StudentController@studentList']);
    Route::get('report/teacher-list', ['as' => 'report.teacher-list', 'uses' => 'TeacherController@teacherList']);
    Route::get('report/course-list', ['as' => 'report.course-list', 'uses' => 'CourseController@courseList']);
});

// autocomplete routes
Route::post('autocomplete.subject-on-course-semester', 'HomeController@subjectOnCourseSemester')->name('autocomplete.subject-on-course-semester');
