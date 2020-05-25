<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePage
 *
 * @package App\Http\Requests
 */
class StorePage extends FormRequest
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
            'content' => 'required|string|min:2',
            'parent_page_id' => 'nullable|exists:pages,id'
        ];
    }
}
