<?php

namespace App\Interfaces;

use Illuminate\Foundation\Http\FormRequest;

interface ApiInterface
{
    /**
     * GET
     *
     * @return mixed
     */
    public function index();

//    /**
//     * GET
//     *
//     * @param $request
//     *
//     * @return mixed
//     */
//    public static function create(FormRequest $request);

    /**
     * GET
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    /**
     * GET
     *
     * @param FormRequest $request
     * @param int $id
     *
     * @return mixed
     */
    public function edit(FormRequest $request, int $id);

    /**
     * DELETE
     *
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
