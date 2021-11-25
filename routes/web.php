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
Route::get('mentors/create', 'MentorController@create')->name('mentors-create');
Route::post('mentors', 'MentorController@store')->name('mentors-store');

/* create student api */
Route::get('students/create', 'StudentController@create')->name('students-create');
Route::post('students', 'StudentController@store')->name('students-store');

// auth middleware
Route::middleware(['auth', 'userApproved'])->group(function () {
    /*---- mentors ----*/
    Route::get('mentors', 'MentorController@index')->name('mentors');
//    Route::get('mentors/single/{mentor}', 'MentorController@show')->name('mentors-show');
    Route::delete('mentors/delete/{mentor}', 'MentorController@destroy')->name('mentors-destroy');
    Route::get('mentors/edit/{mentor}', 'MentorController@edit')->name('mentors-edit');
    Route::put('mentors/update/{mentor}', 'MentorController@update')->name('mentors-update');
    Route::get('mentors/connect/{mentor}', 'MentorController@students')->name('mentors.connect');

    /*---- students ----*/
    Route::get('students', 'StudentController@index')->name('students.index');
//    Route::get('students/single/{student}', 'StudentController@show')->name('students-show');
    Route::delete('students/delete/{student}', 'StudentController@destroy')->name('students-destroy');
    Route::get('students/edit/{student}', 'StudentController@edit')->name('students-edit');
    Route::put('students/update/{student}', 'StudentController@update')->name('students-update');
    Route::get('student-mentor-connect/{student}', 'StudentController@mentors')->name('students.connect');

    // authenticated user is admin
    Route::middleware(['isAdmin'])->group(function () {
        /* student-mentor operations - attach/detach */
        Route::put('student-mentor-attach/student/{student}/mentor/{mentor}', 'StudentController@attachMentor')->name('student-mentor.attach');
        Route::put('student-mentor-detach/student/{student}/mentor/{mentor}', 'StudentController@detachStudentMentor')->name('student-mentor.detach');

        // import data
        Route::post('mentors/import', 'MentorController@importMentors')->name('mentors-import');
        Route::post('students/import', 'StudentController@importStudents')->name('students-import');

        /* users */
        Route::resource('users', 'UserController')->names('users');

        /* users */
        Route::resource('seasons', 'SeasonController')->names('seasons');
    });
});

Route::get('pending-approval', 'HomeController@pendingApproval')
    ->middleware(['auth'])
    ->name('pending-approval');
