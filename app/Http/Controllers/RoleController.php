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
     * @throws \Throwable
     */
    public function store(StoreRole $request): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated());

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
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
     * @throws \Throwable
     */
    public function update(StoreRole $request, Role $role): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $role);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Role  $role
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Role $role): JsonResponse
    {
        $success = $this->repository->delete($role);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
