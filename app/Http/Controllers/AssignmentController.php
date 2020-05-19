<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Assignment;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Assignment::all(), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(Assignment::find($id), 200);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Assignment::destroy($id);
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
