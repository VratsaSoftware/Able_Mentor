<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Setup CORS */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: POST");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* create mentor api */
Route::post('mentors', 'MentorsController@store')->name('mentors-store');

/* create student api */
//Route::post('students', 'StudentsController@store')->name('students-store');
