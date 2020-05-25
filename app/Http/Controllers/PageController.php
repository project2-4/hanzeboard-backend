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
        [$success, $id] = $this->repository->save(array_merge($request->validated(), [
            'course_id' => $course->id
        ]));

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Course $course, Page $page): JsonResponse
    {
        return $this->response($page, 200);
    }

    /**
     * @param  \App\Http\Requests\StorePage  $request
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(StorePage $request, Course $course, Page $page): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $page);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Page  $page
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Course $course, Page $page): JsonResponse
    {
        $success = $this->repository->delete($page);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
