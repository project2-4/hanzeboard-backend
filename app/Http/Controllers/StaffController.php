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
        return $this->response($this->repository->all(), 200);
    }

    /**
     * @param  \App\Models\Staff  $staff
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Staff $staff): JsonResponse
    {
        $extraLinks = [URL::to("/api/user/show/{$staff->id}") => 'GET'];

        return $this->response($staff, 200, $extraLinks);
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
     * @param  \App\Models\Staff  $student
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(StoreStaff $request, Staff $student): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $student);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Staff  $student
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Staff $student): JsonResponse
    {
        $success = $this->repository->delete($student);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
