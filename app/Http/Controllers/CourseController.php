<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CoursesRepository;
use App\Http\Requests\StoreCourse;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class CourseController
 *
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * CourseController constructor.
     *
     * @param  \App\Http\Repositories\CoursesRepository  $repository
     */
    public function __construct(CoursesRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->response(Auth::user()->courses->load('subjects'), 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(): JsonResponse
    {
        return $this->response($this->repository->getPublicCourses(), 200);
    }

    /**
     * @param  \App\Http\Requests\StoreCourse  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(StoreCourse $request): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated());

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Course $course): JsonResponse
    {
        return $this->response($course->load('subjects'), 200);
    }

    /**
     * @param  \App\Http\Requests\StoreCourse  $request
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(StoreCourse $request, Course $course): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $course);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Course $course): JsonResponse
    {
        $success = $this->repository->delete($course);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }

    public function unenroll(Course $course): JsonResponse
    {
        $success = Auth::user()->courses()->detach($course->id) === 1;

        return $this->response(compact('success'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function staff(Course $course): JsonResponse
    {
        $staff = $course
            ->users()
            ->where('profile_type', 'staff')
            ->with('profile')
            ->with('profile.status')
            ->get();

        return $this->response($staff, 200);
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function students(Course $course): JsonResponse
    {
        $students = $course
            ->users()
            ->where('profile_type', 'student')
            ->with('profile')
            ->get();

        return $this->response($students, 200);
    }
}
