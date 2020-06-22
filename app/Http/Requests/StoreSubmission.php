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
class StoreSubmission extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'file' => 'required|file',
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'file' => __('validation.attributes.file')
        ];
    }
}
