<?php
/**
 * Created by PhpStorm.
 * User: ZOKI
 * Date: 10-Apr-21
 * Time: 19:43
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BandRequest extends FormRequest
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
            'id_cities'=>'required',

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
            'name.required' => __('auth.field_required', ['name' => __('properties.bands.index.table_name')]),
            'id_cities.required' => __('auth.field_required', ['name' => __('properties.bands.index.table_sport')]),

        ];
    }
}