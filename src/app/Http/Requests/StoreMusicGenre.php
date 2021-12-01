<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMusicGenre extends FormRequest
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
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:10|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El :attribute es requerido.',
            'name.min' => 'El :attribute debe tener 5 caracteres como mínimo.',
            'name.max' => 'El :attribute puede tener 100 caracteres como máximo.',
            'description.required'  => 'La :attribute es requerido.',
            'description.min' => 'La :attribute debe tener 10 caracteres como mínimo.',
            'description.max' => 'La :attribute puede tener 255 caracteres como máximo.'
        ];
    }



    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'description' => 'descripción'
        ];
    }

}
