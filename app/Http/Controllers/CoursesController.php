<?php

namespace App\Http\Controllers;

class CoursesController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response()->json(['get']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        return response()->json(['test']);
    }
}
