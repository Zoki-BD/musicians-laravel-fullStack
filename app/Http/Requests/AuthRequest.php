<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'username'=>'required',
            //'email'=>'required|email',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => __('auth.field_required', ['name' => __('properties.login.index.username')]),
            'password.required' => __('auth.field_required', ['name' => __('properties.login.index.password')]),
        ];
    }
}
