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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        $rules = array_merge(StoreUser::$rules, [
            'first_name' => 'required|string|min:2|max:191',
            'infix' => 'nullable|string|min:2|max:191',
            'last_name' => 'required|string|min:2|max:191',
            'avatar_url' => 'nullable|string|min:2|max:191',
            'password' => 'required|min:8|max:191',
            'role_id' => 'required|exists:roles,id'
        ]);

        if (request()->method() !== 'POST') {
            $rules['email'] .= ',' . Auth::user()->id;
        }

        return $rules;
    }
}
