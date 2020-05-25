<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SubjectsRepository;
use App\Http\Requests\StoreSubject;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;

/**
 * Class SubjectController
 *
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
{
    /**
     * SubjectController constructor.
     *
     * @param  \App\Http\Repositories\SubjectsRepository  $repository
     */
    public function __construct(SubjectsRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Course $course): JsonResponse
    {
        return $this->response($course->pages, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreSubject  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(StoreSubject $request): JsonResponse
    {
        $success = $this->repository->save($request->validated());

        return $this->response(compact($success), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Subject $subject): JsonResponse
    {
        return $this->response($subject, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreSubject  $request
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(StoreSubject $request, Subject $subject): JsonResponse
    {
        $success = $this->repository->save($request->validated(), $subject);

        return $this->response(compact($success), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Subject $subject): JsonResponse
    {
        $success = $this->repository->delete($subject);

        return $this->response(compact($success), $this->getStatusCode($success));
    }
}
