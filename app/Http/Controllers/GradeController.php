<?php

namespace App\Http\Controllers;

use App\Http\Repositories\GradesRepository;
use App\Http\Requests\StoreGrades;
use App\Models\Assignment;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * StudentController constructor.
     *
     * @param GradesRepository $repository
     */
    public function __construct(GradesRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (Auth::user()->profile_type === 'staff') {
            return $this->response([], 200);
        }

        return $this->response(Auth::user()->profile->grades->load(['recorder.user', 'assignment.subject']), 200);
    }

    /**
     * @param StoreGrades $request
     * @return JsonResponse
     */
    public function store(StoreGrades $request): JsonResponse
    {
        $filename = $request->file('grades')->path();
        $grades = array_map('str_getcsv', file($filename));

        $assignment = Assignment::find($request->get('assignment'));
        $assigner = Staff::find(Auth::user()->profile_id);

        $savedGrades = [];

        foreach ($grades as $grade) {
            try {
                $student = Student::where('student_number', '=', $grade[0])->first();
                $grade = (float) $grade[1];

                $savedGrades[] = $this->repository->newGrade($student, $assignment, $assigner, $grade);
            } catch (\Exception $e) {
                // Continue, not found student, assignment, grade or assigner.
            }
        }

        return $this->response($savedGrades);
    }
}
