<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthor extends FormRequest
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
            'name_lastname' => 'required|min:3|max:255',
            'biography' => 'nullable|string',
            'birth' => 'nullable|date',
            'facebook' => 'nullable|alpha_dash',
            'youtube' => 'nullable|alpha_dash',
            'instagram' => 'nullable|alpha_dash',
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
            'name-lastname.required' => 'Los :attribute son requeridos.',
            'name-lastname.min' => 'Los :attribute debe tener 10 caracteres como mínimo.',
            'name-lastname.max' => 'Los :attribute puede tener 255 caracteres como máximo.',
            'biography.alpha_num' => 'La :attribute sólo puede contener caracteres alfanuméricos.',
            'birth.date' => 'La :attribute debe ser una fecha con el formato mes/día/Año (mm/dd/YYYY).',
            'facebook.alpha_dash' => 'El :attribute sólo puede incluir caracteres alfanuméricos, así como guiones y guiones bajos.',
            'youtube.alpha_dash' => 'El :attribute sólo puede incluir caracteres alfanuméricos, así como guiones y guiones bajos.',
            'instagram.alpha_dash' => 'El :attribute sólo puede incluir caracteres alfanuméricos, así como guiones y guiones bajos.',
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
            'name-lastname' => 'nombres y apellidos',
            'biography' => 'biografía',
            'birth' => 'fecha de nacimiento',
            'facebook' => 'perfil de Facebook',
            'youtube' => 'perfil de Youtube',
            'instagram' => 'perfil de Instagram',
        ];
    }
}
