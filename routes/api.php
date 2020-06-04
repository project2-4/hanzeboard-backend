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
        Route::post('login', 'AuthController@login')->name('auth.login');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout', 'AuthController@logout')->name('auth.logout');
            Route::post('refresh', 'AuthController@refresh')->name('auth.refresh');
            Route::post('me', 'AuthController@me')->name('auth.me');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Authentication required
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware' => ['auth:api']], function () {

        /** Courses */
        Route::get('courses/all', 'CourseController@all')->name('courses.all');
        Route::apiResource('courses', 'CourseController');

        Route::group(['prefix' => 'courses/{course}'], function () {
            Route::get('students', 'CourseController@students')->name('courses.students');
            Route::get('staff', 'CourseController@staff')->name('courses.staff');

            /** Announcements */
            Route::apiResource('announcements', 'AnnouncementController');

            /** Pages */
            Route::apiResource('pages', 'PageController');

            /** subjects */
            Route::apiResource('subjects', 'SubjectController');

            Route::group(['prefix' => 'subjects/{subject}'], function () {

                /** Assignments */
                Route::apiResource('assignments', 'AssignmentController');
            });
        });

        /** Roles */
        Route::apiResource('roles', 'RoleController');

        /** Students */
        Route::apiResource('students', 'StudentController');

        /** Grades */
        Route::apiResource('grades', 'GradeController');

        /** Groups */
        Route::get('groups/me', 'GroupController@me')->name('groups.me');
        Route::apiResource('groups', 'GroupController');

        /** Staff */
        Route::get('staff/me', 'StaffController@me')->name('staff.me');

        /** Admin Authorized actions */
        Route::group(['middleware' => ['auth.admin']], function () {
            /** Staff */
            Route::apiResource('staff', 'StaffController');
            Route::put('staff/{staff}/status', 'StaffStatusController@update');

        });
    });
});
