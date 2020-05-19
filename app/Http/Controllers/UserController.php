<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(User::all(), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(User::find($id), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $success = (boolean) User::destroy($id);
        return $this->response(['success' => $success], 200);
    }

    public function create(\App\Http\Requests\User $request)
    {
        $this->response('sdfdsf', 200);
        dd($validated = $request->validated());
    }
}
