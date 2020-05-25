<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AssignmentsRepository;
use App\Http\Requests\StoreAssignment;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignmentController
 *
 * @package App\Http\Controllers
 */
class AssignmentController extends Controller
{
    /**
     * AssignmentController constructor.
     *
     * @param  \App\Http\Repositories\AssignmentsRepository  $repository
     */
    public function __construct(AssignmentsRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Course $course, Subject $subject): JsonResponse
    {
        return $this->response($subject->assignments, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAssignment  $request
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(StoreAssignment $request, Course $course, Subject $subject): JsonResponse
    {
        [$success, $id] = $this->repository->save(array_merge($request->validated(), [
            'subject' => $subject->id,
            'deadline' => Carbon::createFromFormat('Y-m-d', $request->get('deadline'))
        ]));

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Course $course, Subject $subject, Assignment $assignment): JsonResponse
    {
        return $this->response($assignment, 200);
    }

    /**
     * @param  \App\Http\Requests\StoreAssignment  $request
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(
        StoreAssignment $request,
        Course $course,
        Subject $subject,
        Assignment $assignment
    ): JsonResponse {
        [$success, $id] = $this->repository->save(array_merge($request->validated(), [
            'deadline' => Carbon::createFromFormat('Y-m-d', $request->get('deadline'))
        ]), $assignment);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Course $course, Subject $subject,Assignment $assignment): JsonResponse
    {
        $success = $this->repository->delete($assignment);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
