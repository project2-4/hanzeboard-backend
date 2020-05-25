<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Staff::all(), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(Staff::find($id), 200);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Staff::destroy($id);
        return $this->response(['success' => $success], 200);
    }

    /**
     * @inheritDoc
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function edit(int $id)
    {
        // TODO: Implement edit() method.
    }
}
