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
        return array_merge(StoreUser::$rules, [

        ]);
    }
}
