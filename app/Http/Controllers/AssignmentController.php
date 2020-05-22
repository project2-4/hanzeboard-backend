<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AssignmentsRepository;
use App\Http\Requests\StoreAssignment;
use App\Models\Assignment;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignmentController
 *
 * @package App\Http\Controllers
 */
class AssignmentController extends Controller
{
    /**
     * AssignmentController constructor.
     *
     * @param  \App\Http\Repositories\AssignmentsRepository  $repository
     */
    public function __construct(AssignmentsRepository $repository)
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
     * @param  \App\Http\Requests\StoreAssignment  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAssignment $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
    }

    /**
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Assignment $assignment): JsonResponse
    {
        return $this->response($assignment, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAssignment  $request
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreAssignment $request, Assignment $assignment): JsonResponse
    {
        return $this->response(function () use ($request, $assignment) {
            return $this->repository->save($request->validated(), $assignment);
        });
    }

    /**
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Assignment $assignment): JsonResponse
    {
        return $this->response(function () use ($assignment) {
            return $this->repository->delete($assignment);
        });
    }
}
