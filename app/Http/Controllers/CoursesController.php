<?php

namespace App\Http\Controllers;

class CoursesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response()->json([
            ['foo', 'bar', 'buz']
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        return response()->json([
            [
                'course 1',
                'course 2',
                'course 3'
            ]
        ]);
    }
}
