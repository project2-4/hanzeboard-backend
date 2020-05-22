<?php

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
Route::group(['middleware' => 'api'], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('refresh', 'AuthController@refresh');
            Route::post('me', 'AuthController@me');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Authentication required
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['auth:api', 'jwt.refresh']], function () {
        /*
        |--------------------------------------------------------------------------
        | Courses
        |--------------------------------------------------------------------------
        */
        Route::apiResource('courses', 'CoursesController');

        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */
        Route::apiResource('student', 'StudentController');

        /*
        |--------------------------------------------------------------------------
        | Announcements
        |--------------------------------------------------------------------------
        */
        Route::apiResource('announcement', 'AnnouncementController');

        /*
        |--------------------------------------------------------------------------
        | Assignments
        |--------------------------------------------------------------------------
        */
        Route::apiResource('assignment', 'AssignmentController');

        /*
        |--------------------------------------------------------------------------
        | Pages
        |--------------------------------------------------------------------------
        */
        Route::apiResource('page', 'PageController');

        /*
        |--------------------------------------------------------------------------
        | Staff
        |--------------------------------------------------------------------------
        */
        Route::apiResource('staff', 'StaffController');

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        Route::apiResource('user', 'UserController');

        /*
        |--------------------------------------------------------------------------
        | Subjects
        |--------------------------------------------------------------------------
        */
        Route::apiResource('subject', 'SubjectController');

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        Route::apiResource('role', 'RoleController');

        /*
        |--------------------------------------------------------------------------
        | Groups
        |--------------------------------------------------------------------------
        */
        Route::apiResource('group', 'GroupController');
    });
});
