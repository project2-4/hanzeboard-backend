<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Announcement;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class AnnouncementController extends Controller implements ApiInterface
{
    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(Announcement::find($id), 200);
    }

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->response(Announcement::all(), 200);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Student::destroy($id);
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
