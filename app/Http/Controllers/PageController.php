<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PagesRepository;
use App\Http\Requests\StorePage;
use App\Models\Course;
use App\Models\Page;
use Illuminate\Http\JsonResponse;

/**
 * Class PageController
 *
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    /**
     * PageController constructor.
     *
     * @param  \App\Http\Repositories\PagesRepository  $repository
     */
    public function __construct(PagesRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Course $course): JsonResponse
    {
        return $this->response($course->pages, 200);
    }

    /**
     * @param  \App\Http\Requests\StorePage  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePage $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
    }

    /**
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Page $page): JsonResponse
    {
        return $this->response($page, 200);
    }

    /**
     * @param  \App\Http\Requests\StorePage  $request
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StorePage $request, Page $page): JsonResponse
    {
        return $this->response(function () use ($request, $page) {
            return $this->repository->save($request->validated(), $page);
        });
    }

    /**
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Page $page): JsonResponse
    {
        return $this->response(function () use ($page) {
            return $this->repository->delete($page);
        });
    }
}
