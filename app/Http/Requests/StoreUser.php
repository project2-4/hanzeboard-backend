<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreUser
 *
 * @package App\Http\Requests
 */
class StoreUser extends FormRequest
{
    /**
     * @var string[]
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name'  => 'required'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::$rules;
    }
}
