<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
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

    /**
     * @param \App\Http\Requests\User $request
     *
     * @return mixed|void
     */
    public function create(\App\Http\Requests\User $request)
    {
        dd('asdsad');
        dd($request->validated());
    }

    /**
     * @inheritDoc
     */
    public function edit(FormRequest $request, int $id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }
}
