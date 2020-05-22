<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CoursesRepository;
use App\Http\Requests\StoreCourse;
use App\Models\Course;
use Illuminate\Http\JsonResponse;

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
        return $this->response($this->repository->all(), 200);
    }

    /**
     * @param  \App\Http\Requests\StoreCourse  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCourse $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Course $course): JsonResponse
    {
        return $this->response($course, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreCourse  $request
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreCourse $request, Course $course): JsonResponse
    {
        return $this->response(function () use ($request, $course) {
            return $this->repository->save($request->validated(), $course);
        });
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Course $course): JsonResponse
    {
        return $this->response(function () use ($course) {
            return $this->repository->delete($course);
        });
    }
}
