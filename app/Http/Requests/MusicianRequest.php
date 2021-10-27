<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MusicianRequest extends FormRequest
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

        $rules = [
           'name'=>'required',
            'surname'=>'required',
            'date_birth'=>'required',
            'id_cities'=>'required',
            'id_instruments'=>'required',
            'id_bands'=>'required',
            'sex'=>'required',
        ];
        return $rules;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_name')]),
            'surname.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_surname')]),
            'date_birth.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_date_birth')]),
            'id_cities.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_city')]),
            'id_instruments.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_instruments')]),
            'id_bands.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_band')]),
            'sex.required' => __('auth.field_required', ['name' => __('properties.musicians.index.table_sex')]),
            ];
    }
}
