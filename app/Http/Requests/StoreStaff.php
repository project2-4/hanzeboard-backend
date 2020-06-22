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
    const STATUS_RULES = [
        'status' => 'in:available,leave,sick',
        'until' => 'date|date_format:Y-m-d'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return array_merge(StoreUser::rules(), [
            'abbreviation' => 'required|string|min:4|max:4',
            'office_location' => 'required|string|min:1|max:255'
        ],  self::STATUS_RULES);
    }

    /**
     * @return array|string[]
     */
    public static function statusRules(): array
    {
        return self::STATUS_RULES;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return array_merge(StoreUser::translations(), [
            'abbreviation' => __('validation.attributes.abbreviation'),
            'office_location' => __('validation.attributes.office'),
            'status' => __('validation.attributes.status'),
            'until' => __('validation.attributes.until')
        ]);
    }
}
