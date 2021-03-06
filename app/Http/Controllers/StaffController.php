<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StaffRepository;
use App\Http\Requests\StoreStaff;
use App\Models\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;

class StaffController extends Controller
{
    /**
     * StaffController constructor.
     *
     * @param  \App\Http\Repositories\StaffRepository  $repository
     */
    public function __construct(StaffRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->response($this->repository->all()->load(['user', 'status']), 200);
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return $this->response($this->repository->all(false)->load(['user', 'status']), 200);
    }

    /**
     * @param  \App\Models\Staff  $staff
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Staff $staff): JsonResponse
    {
        return $this->response($staff->load(['user', 'status']), 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function me(): JsonResponse
    {
        return $this->response($this->repository->me(auth()->user()), 200);
    }

    /**
     * @param  \App\Http\Requests\StoreStaff  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(StoreStaff $request): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated());

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Http\Requests\StoreStaff  $request
     * @param  \App\Models\Staff  $staff
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(StoreStaff $request, Staff $staff): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $staff);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Staff  $staff
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Staff $staff): JsonResponse
    {
        $success = $this->repository->delete($staff);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
