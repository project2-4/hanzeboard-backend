<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreSubject
 *
 * @package App\Http\Requests
 */
class StoreSubject extends FormRequest
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
            'page_name' => 'required|string|min:2|max:191',
            'page_content' => 'required|string|min:2',
            'page_items' => 'required|array',
            'page_items.*.title' => 'required|string|min:0|max:191',
            'page_items.*.content' => 'required|string|min:2',
            'page_items.*.type' => 'required|in:text,files,assignment'
        ];
    }
}
