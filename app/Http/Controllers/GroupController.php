<?php

namespace App\Http\Controllers;

use App\Http\Repositories\GroupsRepository;
use App\Http\Requests\StoreGroup;
use App\Models\Group;
use Illuminate\Http\JsonResponse;

/**
 * Class GroupController
 *
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * GroupController constructor.
     *
     * @param  \App\Http\Repositories\GroupsRepository  $repository
     */
    public function __construct(GroupsRepository $repository)
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        if (auth()->user()->isStudent()) {
            $student = auth()->user()->profile();

            return $this->response($student->group, 200);
        }

        return $this->response(['success' => false, 'errors' => 'Staff members do not have groups'], 400);
    }

    /**
     * @param  \App\Http\Requests\StoreGroup  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGroup $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
    }

    /**
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Group $group): JsonResponse
    {
        return $this->response($group, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreGroup  $request
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreGroup $request, Group $group): JsonResponse
    {
        return $this->response(function () use ($request, $group) {
            return $this->repository->save($request->validated(), $group);
        });
    }

    /**
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Group $group): JsonResponse
    {
        return $this->response(function () use ($group) {
            return $this->repository->delete($group);
        });
    }
}
