<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PagesRepository;
use App\Http\Requests\StoreAnnouncement;
use App\Models\Announcement;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->response($this->repository->all(), 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAnnouncement  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAnnouncement $request): JsonResponse
    {
        return $this->response(function () use ($request) {
            return $this->repository->save($request->validated());
        });
    }

    /**
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show(Announcement $announcement): JsonResponse
    {
        return $this->response($announcement, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAnnouncement  $request
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreAnnouncement $request, Announcement $announcement): JsonResponse
    {
        return $this->response(function () use ($request, $announcement) {
            return $this->repository->save($request->validated(), $announcement);
        });
    }

    /**
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Announcement $announcement): JsonResponse
    {
        return $this->response(function () use ($announcement) {
            return $this->repository->delete($announcement);
        });
    }
}
