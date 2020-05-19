<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

class PageController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Page::all(), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(Page::find($id), 200);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Page::destroy($id);
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
