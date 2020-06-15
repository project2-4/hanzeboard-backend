<?php

namespace App\Http\Controllers;

use App\Http\Repositories\GradesRepository;
use App\Http\Repositories\SubmissionsRepository;
use App\Http\Requests\StoreSubmission;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Submission;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * SubmissionController constructor.
     *
     * @param  \App\Http\Repositories\SubmissionsRepository  $repository
     */
    public function __construct(SubmissionsRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Course $course, Subject $subject, Assignment $assignment): JsonResponse
    {
        return $this->response($assignment->submissions()->with('student', 'student.user')->get(), 200);
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment!block.new && block.assignment_id === assignment.id ? 'selected' : null
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Course $course, Subject $subject): JsonResponse
    {
        $assignments = $subject->assignments;
        $response = [];

        // This can be better
        foreach ($assignments as $assignment) {
            $submission = $assignment->submissions()->where('student_id', '=', Auth::user()->profile_id)->orderBy('created_at', 'DESC')->first();
            if($submission) {
                $response[$assignment->id] = $submission;
            }
        }

        return $this->response($response, 200);
    }


    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     * @param  \App\Http\Requests\StoreSubmission  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(
        Course $course,
        Subject $subject,
        Assignment $assignment,
        StoreSubmission $request
    ): JsonResponse {
        $filename = $request->file('file')->store('public');

        [$success, $id] = $this->repository->save([
            'file' => str_replace('public/', '', $filename),
            'assignment_id' => $assignment->id,
            'student_id' => Auth::user()->profile_id
        ]);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Subject  $subject
     * @param  \App\Models\Assignment  $assignment
     * @param  \App\Models\Submission  $submission
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(
        Course $course,
        Subject $subject,
        Assignment $assignment,
        Submission $submission
    ): JsonResponse {
        Storage::disk('public')->delete($submission->file);

        $success = $this->repository->delete($submission);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
