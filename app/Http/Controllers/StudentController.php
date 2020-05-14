<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function get(int $id)
    {
        return response()->json([
            Student::find($id)
        ]);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        $success = (boolean) Student::destroy($id);

        return response()->json([
            'success' => $success
        ]);
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
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request)
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
     * @param $message
     * @param int $code
     *
     * @return JsonResponse
     */
    private function response($message, $code = 200)
    {
        $responseObject = [
            'message' => $message,
            'code' => $code
        ];

        return response()->json($responseObject, $code);
    }
}
