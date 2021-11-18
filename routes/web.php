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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// mentors
Route::get('mentors/list', 'MentorsController@index')->name('mentors');
Route::get('mentors/single/{mentor}', 'MentorsController@show')->name('mentors-show');
Route::get('mentors/delete/{mentor}', 'MentorsController@delete')->name('mentors-delete');
Route::delete('mentors/delete/{mentor}', 'MentorsController@destroy')->name('mentors-destroy');
Route::get('mentors/edit/{mentor}', 'MentorsController@edit')->name('mentors-edit');
Route::put('mentors/update/{mentor}', 'MentorsController@update')->name('mentors-update');
Route::get('mentors/connect/{mentor}', 'MentorsController@listAllStudents')->name('mentors-connect');
Route::get('mentors/connect-student/{mentor}/{student}', 'MentorsController@connectStudent')->name('mentors-connect-student');
Route::put('mentors/connect-student/{mentor}/{student}', 'MentorsController@confirmConnectStudent')->name('mentors-confirm-connect');
Route::get('mentors/create', 'MentorsController@create')->name('mentors-create');
Route::post('mentors', 'MentorsController@store')->name('mentors-store');

// students
Route::get('students/list', 'StudentsController@index')->name('students');
Route::get('students/single/{student}', 'StudentsController@show')->name('students-show');
Route::get('students/create', 'StudentsController@create')->name('students-create');
Route::post('students', 'StudentsController@store')->name('students-store');
Route::delete('students/delete/{student}', 'StudentsController@destroy')->name('students-destroy');
Route::get('students/edit/{student}', 'StudentsController@edit')->name('students-edit');
Route::put('students/update/{student}', 'StudentsController@update')->name('students-update');
Route::get('students/connect/{student}', 'StudentsController@listAllMentors')->name('students-connect');
Route::get('students/connect-mentor/{student}/{mentor}', 'StudentsController@connectMentor')->name('students-connect-mentor');
Route::put('students/connect-mentor/{student}/{mentor}', 'StudentsController@confirmConnectMentor')->name('students-confirm-connect');
