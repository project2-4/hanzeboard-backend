<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Course;
use Illuminate\Http\JsonResponse;

class CoursesController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Course::all(), 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->response(Course::find($id), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $success = (boolean) Course::destroy($id);
        return $this->response(['success' => $success], 200);
    }
}
