<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AnnouncementsRepository;
use App\Http\Requests\StoreAnnouncement;
use App\Models\Announcement;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class AnnouncementController
 *
 * @package App\Http\Controllers
 */
class AnnouncementController extends Controller
{
    /**
     * AnnouncementController constructor.
     *
     * @param  \App\Http\Repositories\AnnouncementsRepository  $repository
     */
    public function __construct(AnnouncementsRepository $repository)
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
        return $this->response($course->subjects, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAnnouncement  $request
     * @param  \App\Models\Course  $course
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(StoreAnnouncement $request, Course $course): JsonResponse
    {
        $success = $this->repository->save(array_merge($request->validated(), [
            'posted_by' => Auth::user()->profile()->id,
            'course_id' => $course->id
        ]));

        return $this->response(compact($success), $this->getStatusCode($success));
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
     * @throws \Throwable
     */
    public function update(StoreAnnouncement $request, Announcement $announcement): JsonResponse
    {
        $success = $this->repository->save($request->validated(), $announcement);

        return $this->response(compact($success), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Announcement $announcement): JsonResponse
    {
        $success = $this->repository->delete($announcement);

        return $this->response(compact($success), $this->getStatusCode($success));
    }
}
