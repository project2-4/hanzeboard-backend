<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StaffStatusRepository;
use App\Http\Requests\StoreStaffStatus;
use App\Models\Staff;
use Illuminate\Http\JsonResponse;

class StaffStatusController extends Controller
{
    /**
     * StaffController constructor.
     *
     * @param StaffStatusRepository $repository
     */
    public function __construct(StaffStatusRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param StoreStaffStatus $request
     * @param Staff $staff
     *
     * @return JsonResponse
     */
    public function update(StoreStaffStatus $request, Staff $staff): JsonResponse
    {
        [$success, $id] = $this->repository->update($request->validated(), $staff);

        return $this->response([compact('success', 'id')], $this->getStatusCode($success));
    }
}
