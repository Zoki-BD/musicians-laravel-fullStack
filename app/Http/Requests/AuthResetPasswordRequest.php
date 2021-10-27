<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('auth.field_required', ['name' => __('properties.login.password-reset.email_placeholder')]),
            'email.email' => __('auth.field_email', ['name' => __('properties.login.password-reset.email_placeholder')]),
            'email.exists' => __('auth.field_exists', ['name' => __('properties.login.password-reset.email_placeholder')]),
        ];
    }
}
