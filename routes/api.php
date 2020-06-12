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

        Route::post('refresh', 'AuthController@refresh')
            ->middleware('auth.refresh')
            ->name('auth.refresh');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout', 'AuthController@logout')->name('auth.logout');
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
        Route::apiResource('courses', 'CourseController')->only(['index', 'show']);

        Route::group(['prefix' => 'courses/{course}'], function () {
            Route::get('students', 'CourseController@students')->name('courses.students');
            Route::get('staff', 'CourseController@staff')->name('courses.staff');

            /** Announcements */
            Route::apiResource('announcements', 'AnnouncementController')->only(['index', 'show']);

            /** Pages */
            Route::apiResource('pages', 'PageController')->only(['index', 'show']);

            /** Subjects */
            Route::apiResource('subjects', 'SubjectController')->only(['index', 'show']);

            Route::group(['prefix' => 'subjects/{subject}'], function () {
                /** Assignments */
                Route::apiResource('assignments', 'AssignmentController')->only(['index', 'show']);
                /** Submissions */
                Route::apiResource('assignments/{assignment}/submissions', 'SubmissionController')
                    ->only(['store']);
            });
        });

        /** Grades */
        Route::apiResource('grades', 'GradeController')->only(['index', 'show']);

        /** Groups */
        Route::get('groups/me', 'GroupController@me')->name('groups.me');
        Route::apiResource('groups', 'GroupController')->only(['index', 'show']);

        /** Staff */
        Route::get('staff/me', 'StaffController@me')->name('staff.me');

        /** Admin Authorized actions */
        Route::group(['middleware' => ['auth.staff']], function () {
            /** Courses */
            Route::apiResource('courses', 'CourseController')->only(['store', 'update', 'destroy']);

            Route::group(['prefix' => 'courses/{course}'], function () {
                /** Announcements */
                Route::apiResource('announcements', 'AnnouncementController')->only(['store', 'update', 'destroy']);

                /** Pages */
                Route::apiResource('pages', 'PageController')->only(['store', 'update', 'destroy']);

                /** Subjects */
                Route::apiResource('subjects', 'SubjectController')->only(['store', 'update', 'destroy']);

                Route::group(['prefix' => 'subjects/{subject}'], function () {
                    /** Assignments */
                    Route::apiResource('assignments', 'AssignmentController')->only(['store', 'update', 'destroy']);
                    /** Submissions */
                    Route::apiResource('assignments/{assignment}/submissions', 'SubmissionController')
                        ->only(['index', 'destroy']);
                });
            });

            /** Grades */
            Route::apiResource('grades', 'GradeController')->only(['store', 'update', 'destroy']);

            /** Groups */
            Route::apiResource('groups', 'GroupController')->only(['store', 'update', 'destroy']);

            /** Staff */
            Route::apiResource('staff', 'StaffController');
            Route::put('staff/{staff}/status', 'StaffStatusController@update')->name('staff.status');;

            /** Students */
            Route::apiResource('students', 'StudentController');

            /** Roles */
            Route::apiResource('roles', 'RoleController');
        });
    });
});
