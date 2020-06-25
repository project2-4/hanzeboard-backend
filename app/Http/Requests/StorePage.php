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
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:191',
            'content' => 'required|string|min:2',
            'parent_page_id' => 'nullable|exists:pages,id'
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.name'),
            'content' => __('validation.attributes.content'),
            'parent_page_id' => __('validation.attributes.parent_page')
        ];
    }
}
