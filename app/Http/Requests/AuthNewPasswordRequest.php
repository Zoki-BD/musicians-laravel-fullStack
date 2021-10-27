<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthNewPasswordRequest extends FormRequest
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
            'hash' => 'required|exists:users,reset_password_hash',
            'new-password'=>'required|min:8',
            'confirm-password'=>'required|same:new-password',
        ];
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function messages()
    {

        //var_dump('test');die;
        return [

            'hash.required' => __('auth.field_required', ['name' => __('properties.login.password-new.hash')]),
            'new-password.required' => __('auth.field_required', ['name' => __('properties.login.password-new.new_password')]),
            'confirm-password.required' => __('auth.field_required', ['name' => __('properties.login.password-new.confirm_new_password')]),


             'hash.exists' => __('auth.exists', ['attribute' => __('properties.login.new-password.hash')]),
             'new-password.min' => __('auth.min.string', ['attribute' => __('properties.login.password-new.new_password')]),
             'confirm-password.same' => __('auth.same', ['attribute' => __('properties.login.password-new.new_password'), 'other' => __('properties.login.password-new.confirm_new_password')]),
        ];
    }
}
