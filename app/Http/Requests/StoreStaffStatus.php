<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests
 */
class StoreStaffStatus extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:available,leave,sick',
            'until' => 'required|date|date_format:Y-m-d|after:now'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'status' => __('validation.attributes.status'),
            'until' => __('validation.attributes.until')
        ];
    }
}
