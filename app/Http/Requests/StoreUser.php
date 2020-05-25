<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $rules = [
            'first_name' => 'required|string|min:2|max:191',
            'infix' => 'nullable|string|min:2|max:191',
            'email' => ['required', 'email'],
            'last_name' => 'required|string|min:2|max:191',
            'avatar_url' => 'nullable|string|min:2|max:191',
            'password' => 'required|confirmed|min:8|max:191',
            'role_id' => 'required|exists:roles,id'
        ];

        if (request()->method() !== 'POST') {
            $rules['email'][] = Rule::unique('users', 'id')->ignore(Auth::user()->id);
        }

        return $rules;
    }
}
