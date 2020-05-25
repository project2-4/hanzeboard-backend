<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StudentsRepository;
use App\Http\Requests\StoreUser;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class StudentController extends Controller
{
    /**
     * StudentController constructor.
     *
     * @param  \App\Http\Repositories\StudentsRepository  $repository
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
     * @param  \App\Models\Student  $student
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Student $student)
    {
        $extraLinks = [
            URL::to('/') . 'api/user/show/' . $student->id => 'GET'
        ];

        return $this->response($student, 200, $extraLinks);
    }

    /**
     * @param \App\Http\Requests\StoreUser  $request
     *
     * @return JsonResponse
     */
    public function store(StoreStudent $request)
    {
        if (!$content = $request->getContent()) {
            return $this->response("Invalid request", 400);
        }

        $content = json_decode($content, true);
        $studentArray = $content['student'] ?? [];

        if (!isset($studentArray['user'])) {
            return $this->response("User has to be defined", 400);
        }

        $userContent = $studentArray['user'];

        if (isset($userContent['email'])) {
            $userExists = User::where('email', '=', $userContent['email'])->firstOrFail();

            if ($userExists) {
                return $this->response("User already exists with email" . $userContent['email'], 422);
            }
        }

        if (isset($userContent['password'])) {
            $userContent['password'] = bcrypt($userContent['password']);
        }

        unset($studentArray['user']);

        try {
            $userContent['profile_id'] = factory(Student::class)->create($studentArray);
            $user = factory(User::class)->create($userContent);
        } catch (Exception $exception) {
            return $this->response("Something went wrong, try again later", 500);
        }

        return $this->response($user);
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $student = Student::find($id);
        $content = json_decode($request->getContent(), true);

        //TODO: Update student here with request content
        $student->save();

        return response()->json($student);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Student::destroy($id);
        return $this->response(['success' => $success], 200);
    }
}
