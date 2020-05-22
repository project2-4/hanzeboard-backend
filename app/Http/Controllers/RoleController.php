<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RolesRepository;
use App\Http\Requests\StoreRole;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{
    /**
     * RoleController constructor.
     *
     * @param  \App\Http\Repositories\RolesRepository  $repository
     */
    public function __construct(RolesRepository $repository)
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
     * @param  \App\Http\Requests\StoreRole  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRole $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
    }

    /**
     * @param  \App\Models\Role  $role
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Role $role): JsonResponse
    {
        return $this->response($role, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreRole  $request
     * @param  \App\Models\Role  $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreRole $request, Role $role): JsonResponse
    {
        return $this->response(function () use ($request, $role) {
            return $this->repository->save($request->validated(), $role);
        });
    }

    /**
     * @param  \App\Models\Role  $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        return $this->response(function () use ($role) {
            return $this->repository->delete($role);
        });
    }
}
