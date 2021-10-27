<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email,0,deleted',
           // 'email' => ['required','email',Rule::exists('staff')->where(function ($query) {$query->where('account_id', 1);})],
            'username'=>'required|unique:users,username,0,deleted',
            'password'=>'required|min:8|required_with:confirm-password|same:confirm-password',
            'confirm-password'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('auth.field_required', ['name' => __('properties.users.index.table_name')]),
            'surname.required' => __('auth.field_required', ['name' => __('properties.users.index.table_surname')]),
            'email.required' => __('auth.field_required', ['name' => __('properties.users.index.table_email')]),
            'email.email' => __('auth.field_email', ['name' => __('properties.users.index.table_email')]),
            'email.unique' => __('auth.field-email-exists', ['name' => __('properties.users.index.table_email')]),
            'username.required' => __('auth.field_required', ['name' => __('properties.users.index.table_username')]),
            'username.unique' => __('auth.field-username-exists', ['name' => __('properties.users.index.table_username')]),

            'password.required' => __('auth.field_required', ['name' => __('properties.users.index.table_password')]),
            'confirm-password.required' => __('auth.field_required', ['name' => __('properties.users.index.table_confirm_password')]),


            'password.min' => __('auth.min.string', ['attribute' => __('properties.users.index.table_password')]),
            'password.same' => __('auth.same', ['attribute' => __('properties.users.index.table_password'), 'other' => __('properties.users.index.table_confirm_password')]),


        ];
    }
}
