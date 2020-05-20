<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Subject::all(), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(Subject::find($id), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $success = (boolean) Subject::destroy($id);
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
    public function edit()
    {
        // TODO: Implement edit() method.
    }
}
