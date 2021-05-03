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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mentors/list', 'MentorsController@index')->name('mentors');
Route::get('/students/list', 'StudentsController@index')->name('students');
Route::get('/students/single/{student}', 'StudentsController@show')->name('students-show');
Route::get('/students/delete/{student}', 'StudentsController@delete')->name('students-delete');
Route::get('/students/update/{student}', 'StudentsController@update')->name('students-update');
