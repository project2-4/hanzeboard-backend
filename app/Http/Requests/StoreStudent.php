<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests
 */
class StoreStudent extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(StoreUser::rules(), [
            'student_number' => 'required|min:0',
            'group_id' => 'nullable|exists:groups,id'
        ]);
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return array_merge(StoreUser::translations(), [
            'student_number' => __('validation.attributes.student_number'),
            'group_id' => __('validation.attributes.group')
        ]);
    }
}
