<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests
 */
class StoreGrades extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'grades' => 'required|file',
            'assignment' => 'required|int'
        ];
    }
}
