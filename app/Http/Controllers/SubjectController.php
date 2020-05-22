<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SubjectsRepository;
use App\Http\Requests\StoreSubject;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->response($this->repository->all(), 200);
    }

    /**
     * @param  \App\Http\Requests\StoreSubject  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubject $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
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
     */
    public function update(StoreSubject $request, Subject $subject): JsonResponse
    {
        return $this->response(function () use ($request, $subject) {
            return $this->repository->save($request->validated(), $subject);
        });
    }

    /**
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Subject $subject): JsonResponse
    {
        return $this->response(function () use ($subject) {
            return $this->repository->delete($subject);
        });
    }
}
