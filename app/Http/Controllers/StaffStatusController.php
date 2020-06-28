<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StaffStatusRepository;
use App\Http\Requests\StoreStaffStatus;
use App\Models\Staff;
use Carbon\Carbon;
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
        [$success, $id] = $this->repository->update(array_merge($request->validated(), [
            'until' => Carbon::createFromFormat('Y-m-d', $request->get('until'))
        ]), $staff);

        return $this->response([compact('success', 'id')], $this->getStatusCode($success));
    }
}
