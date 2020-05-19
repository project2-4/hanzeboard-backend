<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Group;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Group::all(), 200);
    }

    /**
     * @inheritDoc
     */
    public function show(int $id)
    {
        return $this->response(Group::find($id), 200);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Group::destroy($id);
        return $this->response(['success' => $success], 200);
    }


    /**
     * @inheritDoc
     */
    public function edit(int $id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * @inheritDoc
     */
    public function create()
    {
        // TODO: Implement create() method.
    }
}
