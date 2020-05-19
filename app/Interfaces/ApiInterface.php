<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ApiInterface
{
    /**
     * GET
     *
     * @return mixed
     */
    public function index();

    /**
     * GET
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request);

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
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     */
    public function edit(Request $request, int $id);

    /**
     * DELETE
     *
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
