<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $userId = request()->route('id');
        $password = request()->get('password');
        $confirmPassword = request()->get('confirm-password');




        $rules = [
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required|email|unique:users,email,'.$userId.',id',
            'username'=>'required|unique:users,username,'.$userId.',id',
        ];

        if(!empty($password) || !empty($confirmPassword)) {
            $rules['password'] = 'required|min:8|required_with:confirm-password|same:confirm-password';
            $rules['confirm-password'] = 'required';
        }

        return $rules;
    }
    public function messages()
    {

        $password = request()->get('password');
        $confirmPassword = request()->get('confirm-password');


        $messages= [
            'name.required' => __('auth.field_required', ['name' => __('properties.users.index.table_name')]),
            'surname.required' => __('auth.field_required', ['name' => __('properties.users.index.table_surname')]),
            'email.required' => __('auth.field_required', ['name' => __('properties.users.index.table_email')]),
            'email.email' => __('auth.field_email', ['name' => __('properties.users.index.table_email')]),
            'email.unique' => __('auth.field-email-exists', ['name' => __('properties.users.index.table_email')]),
            'username.required' => __('auth.field_required', ['name' => __('properties.users.index.table_username')]),
            'username.unique' => __('auth.field-username-exists', ['name' => __('properties.users.index.table_username')]),

        ];

        if(!empty($password) || !empty($confirmPassword)) {
            $messages['password.min'] = __('auth.min.string', ['attribute' => __('properties.users.index.table_password')]);
            $messages['password.same'] = __('auth.same', ['attribute' => __('properties.users.index.table_password'), 'other' => __('properties.users.index.table_confirm_password')]);
        }




        return $messages;
    }


}
