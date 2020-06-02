<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StudentsRepository;
use App\Http\Requests\StoreStudent;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Throwable;

class StudentController extends Controller
{
    /**
     * StudentController constructor.
     *
     * @param StudentsRepository $repository
     */
    public function __construct(StudentsRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->response($this->repository->all(), 200);
    }

    /**
     * @param Student $student
     *
     * @return JsonResponse
     */
    public function show(Student $student): JsonResponse
    {
        return $this->response($student->load(['user', 'grades']), 200);
    }

    /**
     * @param StoreStudent $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreStudent $request): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated());

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param StoreStudent $request
     * @param Student $student
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(StoreStudent $request, Student $student): JsonResponse
    {
        [$success, $id] = $this->repository->save($request->validated(), $student);

        return $this->response(compact('success', 'id'), $this->getStatusCode($success));
    }

    /**
     * @param Student $student
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Student $student): JsonResponse
    {
        $success = $this->repository->delete($student);

        return $this->response(compact('success'), $this->getStatusCode($success));
    }
}
