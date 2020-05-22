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
    //Route::group(['middleware' => ['auth:api', 'jwt.refresh']], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        /*
        |--------------------------------------------------------------------------
        | Courses
        |--------------------------------------------------------------------------
        */
        Route::get('courses/all', 'CourseController@all')->name('courses.all');
        Route::apiResource('courses', 'CourseController');

        Route::group(['prefix' => 'courses/{course}'], function () {
            /*
            |--------------------------------------------------------------------------
            | Announcements
            |--------------------------------------------------------------------------
            */
            Route::apiResource('announcements', 'AnnouncementController');

            /*
            |--------------------------------------------------------------------------
            | Pages
            |--------------------------------------------------------------------------
            */
            Route::apiResource('pages', 'PageController');

            /*
            |--------------------------------------------------------------------------
            | Subjects
            |--------------------------------------------------------------------------
            */
            Route::apiResource('subjects', 'SubjectController');

            Route::group(['prefix' => 'subjects/{subject}'], function () {
                /*
                |--------------------------------------------------------------------------
                | Assignments
                |--------------------------------------------------------------------------
                */
                Route::apiResource('assignments', 'AssignmentController');
            });
        });

        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */
        Route::apiResource('students', 'StudentController');

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
        Route::apiResource('users', 'UserController');

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        Route::apiResource('roles', 'RoleController');

        /*
        |--------------------------------------------------------------------------
        | Groups
        |--------------------------------------------------------------------------
        */
        Route::apiResource('groups', 'GroupController');
    });
});
