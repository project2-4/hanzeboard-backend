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
    public function rules()
    {
        return array_merge(StoreUser::rules(), [
            'student_number' => 'required|min:0',
            'group_id' => 'nullable|exists:groups,id'
        ]);
    }
}