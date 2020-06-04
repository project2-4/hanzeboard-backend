<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCourse
 *
 * @package App\Http\Requests
 */
class StoreCourse extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:191',
            'staff_ids' => 'required|array',
            'staff_ids.*' => 'exists:staff,id',
            'group_ids' => 'required|array',
            'group_ids.*' => 'exists:groups,id',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
            'is_public' => 'required|boolean',
            'subjects' => 'required|array',
            'subjects.*' => 'required|string|min:2|max:191'
        ];
    }
}
