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
            'page_items' => 'nullable|array',
            'page_items.*.id' => 'nullable|int|exists:page_items,id',
            'page_items.*.deleted' => 'required|boolean',
            'page_items.*.title' => 'nullable|string|min:0|max:191',
            'page_items.*.content' => 'nullable|string|min:2',
            'page_items.*.type' => 'nullable|in:text,files,assignment',
            'page_items.*.assignment_id' => 'nullable|exists:assignments,id',
            'page_items.*.files' => 'nullable|array',
            'page_items.*.files.*' => 'nullable|file',
        ];
    }
}
