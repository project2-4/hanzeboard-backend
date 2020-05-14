<?php

use App\Models\Student;
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
Route::group([
    'middleware' => 'api'
], function () {

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

    Route::get('test', 'CoursesController@test');

    Route::group([
        'middleware' => ['auth:api', 'jwt.refresh']
    ], function () {
        Route::get('courses', 'CoursesController@get');
    });

    /**************************     *********************/
    /************************** API *********************/
    /**************************     *********************/

    Route::group([
        'prefix' => 'student'
    ], function() {
        Route::get('{id}', 'StudentController@get');
        Route::delete('{id}', 'StudentController@delete');
        Route::get('{id}/edit', 'StudentController@edit');
        Route::put('new', 'StudentController@new');
    });
});
