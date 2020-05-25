<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreAnnouncement
 *
 * @package App\Http\Requests
 */
class StoreAnnouncement extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:191',
            'content' => 'required|string|min:5',
        ];
    }
}
