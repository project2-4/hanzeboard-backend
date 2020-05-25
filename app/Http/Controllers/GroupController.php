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
     * @throws \Throwable
     */
    public function store(StoreGroup $request): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated());

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
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
     * @throws \Throwable
     */
    public function update(StoreGroup $request, Group $group): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $group);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Group  $group
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Group $group): JsonResponse
    {
        $success = $this->repository->delete($group);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
