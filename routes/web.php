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

// auth routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* create mentor api */
Route::get('mentors/create', 'MentorsController@create')->name('mentors-create');
Route::post('mentors', 'MentorsController@store')->name('mentors-store');

/* create student api */
Route::get('students/create', 'StudentsController@create')->name('students-create');
Route::post('students', 'StudentsController@store')->name('students-store');

// auth middleware
Route::middleware(['auth', 'userApproved'])->group(function () {
    /*---- mentors ----*/
    Route::get('mentors', 'MentorsController@index')->name('mentors');
//    Route::get('mentors/single/{mentor}', 'MentorsController@show')->name('mentors-show');
    Route::delete('mentors/delete/{mentor}', 'MentorsController@destroy')->name('mentors-destroy');
    Route::get('mentors/edit/{mentor}', 'MentorsController@edit')->name('mentors-edit');
    Route::put('mentors/update/{mentor}', 'MentorsController@update')->name('mentors-update');
    Route::get('mentors/connect/{mentor}', 'MentorsController@students')->name('mentors.connect');
    Route::put('mentors/mentor-approve/{mentor}', 'MentorsController@mentorApprove')->name('mentor-approve');

    /*---- students ----*/
    Route::get('students', 'StudentsController@index')->name('students.index');
//    Route::get('students/single/{student}', 'StudentsController@show')->name('students-show');
    Route::delete('students/delete/{student}', 'StudentsController@destroy')->name('students-destroy');
    Route::get('students/edit/{student}', 'StudentsController@edit')->name('students-edit');
    Route::put('students/update/{student}', 'StudentsController@update')->name('students-update');
    Route::put('students/student-approve/{student}', 'StudentsController@studentApprove')->name('student-approve');
    Route::get('student-mentor-connect/{student}', 'StudentsController@mentors')->name('students.connect');

    /* student-mentor operations - attach/detach */
    Route::put('student-mentor-attach/student/{student}/mentor/{mentor}', 'StudentsController@attachMentor')->name('student-mentor.attach');
    Route::put('student-mentor-detach/student/{student}/mentor/{mentor}', 'StudentsController@detachStudentMentor')->name('student-mentor.detach');

    // import data
    Route::post('mentors/import', 'MentorsController@importMentors')->name('mentors-import');
    Route::post('students/import', 'StudentsController@importStudents')->name('students-import');

    /* users */
    Route::resource('users', 'UserController')->names('users');

    Route::get('pending-approval', 'HomeController@pendingApproval')->name('pending-approval');
});
