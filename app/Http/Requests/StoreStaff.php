<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests
 */
class StoreStaff extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(StoreUser::rules(), [
            'abbreviation' => 'required|string|min:4|max:4',
            'status' => 'required|string|min:1|max:255',
            'office_location' => 'required|string|min:1|max:255',
        ]);
    }
}
