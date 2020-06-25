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
    public function rules(): array
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

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.title'),
            'page_name' => __('validation.attributes.page_name'),
            'page_content' => __('validation.attributes.page_content'),
            'page_items' => __('validation.attributes.page_items'),
            'page_items.*.id' => __('validation.attributes.page_items'),
            'page_items.*.deleted' => __('validation.attributes.page_items_deleted'),
            'page_items.*.title' => __('validation.attributes.page_items_title'),
            'page_items.*.content' => __('validation.attributes.page_items_content'),
            'page_items.*.type' => __('validation.attributes.page_items_type'),
            'page_items.*.assignment_id' => __('validation.attributes.page_items_assignment'),
            'page_items.*.files' => __('validation.attributes.page_items_files'),
            'page_items.*.files.*' => __('validation.attributes.page_items_files')
        ];
    }
}
