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
            'role_id' => 'required|exists:roles,id'
        ];
        if (request()->getMethod() !== 'POST') {
            $profile = request()->route('staff');

            if (is_null($profile)) {
                $profile = request()->route('student');
            }

            $rules['email'][] = Rule::unique('users', 'email')->ignore($profile->user->id);
        } else {
            $rules['email'][] = Rule::unique('users', 'email');
        }

        return $rules;
    }

    /**
     * @return array
     */
    public static function translations(): array
    {
        return [
            'first_name' => __('validation.attributes.first_name'),
            'infix' => __('validation.attributes.infix'),
            'email' => __('validation.attributes.email'),
            'last_name' => __('validation.attributes.last_name'),
            'avatar_url' => __('validation.attributes.avatar_url'),
            'role_id' => __('validation.attributes.role')
        ];
    }
}
