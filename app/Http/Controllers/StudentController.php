<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL;

class StudentController extends Controller implements ApiInterface
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(User::all()->where('profile_type', '=', 'student'), 200);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $extraLinks = [
            URL::to('/') . 'api/user/show/' . $id => 'GET'
        ];

        return $this->response(Student::find($id), 200, $extraLinks);
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(Request $request, int $id)
    {
        $student = Student::find($id);
        $content = json_decode($request->getContent(), true);

        //TODO: Update student here with request content
        $student->save();

        return response()->json($student);
    }

    /**
     * @param \App\Http\Requests\User $request
     * @return JsonResponse
     */
    public function create(\App\Http\Requests\User $request)
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
     * @inheritDoc
     */
    public function destroy(int $id)
    {
        $success = (boolean) Student::destroy($id);
        return $this->response(['success' => $success], 200);
    }
}
