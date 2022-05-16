<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('home', 'HomeController@index')
    ->name('home');

// auth middleware
Route::middleware(['auth', 'userApproved'])->group(function () {
    /*---- mentors ----*/
    Route::get('mentors/{status?}', 'MentorController@index')
        ->name('mentors.index');

    Route::get('mentor/{mentorId}', 'MentorController@show')
        ->name('mentor.show');

    Route::get('mentors-archive', 'MentorController@archive')
        ->name('mentors.archive');

    Route::delete('mentors/delete/{mentor}', 'MentorController@destroy')
        ->name('mentors-destroy');

    Route::get('mentors/edit/{mentorId}', 'MentorController@edit')
        ->name('mentor.edit');

    Route::put('mentors/update/{mentor}', 'MentorController@update')
        ->name('mentors-update');

    Route::get('mentors/connect/{mentor}', 'MentorController@students')
        ->name('mentors.connect');

    /*---- students ----*/
    Route::get('students/{status?}', 'StudentController@index')
        ->name('students.index');

    Route::get('student/{studentId}', 'StudentController@show')
        ->name('student.show');

    Route::get('students-archive', 'StudentController@archive')
        ->name('students.archive');

    Route::delete('students/delete/{student}', 'StudentController@destroy')
        ->name('students-destroy');

    Route::get('students/edit/{student}', 'StudentController@edit')
        ->name('students-edit');

    Route::put('students/update/{student}', 'StudentController@update')
        ->name('students-update');

    Route::get('student-mentor-connect/{student}', 'StudentController@mentors')
        ->name('students.connect');

    // archive
    Route::get('archive', 'HomeController@archive')
        ->name('archive');

    Route::get('mode', 'HomeController@changeMode')
        ->name('change-mode');

    /*---- authenticated user is admin ----*/
    Route::middleware(['isAdmin'])->group(function () {
        /* student-mentor operations - attach/detach */
        Route::put('student-mentor-attach/student/{student}/mentor/{mentor}', 'StudentController@attachMentor')
            ->name('student-mentor.attach');

        Route::put('student-mentor-detach/student/{student}/mentor/{mentor}', 'StudentController@detachMentors')
            ->name('student-mentor.detach');

        // import data
        Route::post('mentors/import', 'MentorController@import')
            ->name('mentors-import');

        Route::post('students/import', 'StudentController@import')
            ->name('students-import');

        /* users */
        Route::resource('users', 'UserController')
            ->names('users');

        /* users */
        Route::resource('seasons', 'SeasonController')
            ->names('seasons');
    });
});

Route::get('pending-approval', 'HomeController@pendingApproval')
    ->middleware(['auth'])
    ->name('pending-approval');
