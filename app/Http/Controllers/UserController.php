<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
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
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) User::destroy($id);
        return $this->response(['success' => $success], 200);
    }

    /**
     * @param \App\Http\Requests\StoreUser $request
     *
     * @return mixed|void
     */
    public function create(\App\Http\Requests\StoreUser $request)
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
}
