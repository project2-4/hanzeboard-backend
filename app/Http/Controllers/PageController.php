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
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(StorePage $request, Course $course): JsonResponse
    {
        $success = $this->repository->save(array_merge($request->validated(), [
            'course_id' => $course->id
        ]));

        return $this->response(compact($success), $this->getStatusCode($success));
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
     * @throws \Throwable
     */
    public function update(StorePage $request, Page $page): JsonResponse
    {
        $success = $this->repository->save($request->validated(), $page);

        return $this->response(compact($success), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Page $page): JsonResponse
    {
        $success = $this->repository->delete($page);

        return $this->response(compact($success), $this->getStatusCode($success));
    }
}
