<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreAssignment
 *
 * @package App\Http\Requests
 */
class StoreAssignment extends FormRequest
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
            'type' => 'required|string|in:MC,open|mixed',
            'credits' => 'required|int|between:0,60',
            'deadline' => 'required|date|date_format:Y-m-d|after:now'
        ];
    }
}
