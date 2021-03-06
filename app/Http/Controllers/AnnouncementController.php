<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AnnouncementsRepository;
use App\Http\Requests\StoreAnnouncement;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\User;
use App\Notifications\NewAnnouncement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        return $this->response($course->load('announcements.poster.user')->announcements, 200);
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
        [$success, $id] = $this->repository->save(array_merge($request->validated(), [
            'posted_by' => Auth::user()->profile_id,
            'course_id' => $course->id
        ]));

        $this->notifyStudents(
            $request->get('title'),
            $request->get('content'),
            $course
        );

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Course $course, Announcement $announcement): JsonResponse
    {
        return $this->response($announcement, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAnnouncement  $request
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(StoreAnnouncement $request, Course $course, Announcement $announcement): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $announcement);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Announcement  $announcement
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Course $course, Announcement $announcement): JsonResponse
    {
        $success = $this->repository->delete($announcement);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }

    /**
     * @param  string  $title
     * @param  string  $content
     * @param  \App\Models\Course  $course
     */
    private function notifyStudents(string $title, string $content, Course $course)
    {
        if (config('announcements.debug')) {
            $users = User::where('email', 'admin@hanze.nl')->get();
        } else {
            $users = $course->users()
                ->where('profile_type', 'student');
        }

        Notification::send($users, new NewAnnouncement($title, $content, Auth::user()->full_name, $course));
    }
}
