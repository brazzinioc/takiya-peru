<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSong extends FormRequest
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
            'title' => 'required|max:255',
            'lyrics_que' => 'required|string',
            'lyrics_spn' => 'nullable|string',
            'lyrics_eng' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:8192',
            'iframe' => 'nullable|string',
            'id_genre' => 'required|numeric|gt:0',
            'id_author' => 'required|numeric|gt:0',
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
            'title.required' => 'El :attribute es requerido.',
            'title.max' => 'El :attribute puede tener 255 caracteres como máximo.',
            'lyrics_que.required' => 'Las :attribute es requerido.',
            'id_genre.required' => 'El :attribute es requerido.',
            'id_genre.numeric' => 'Seleccione un :attribute válido.',
            'id_genre.gt' => 'Seleccione un :attribute válido.',
            'id_author.required' => 'El :attribute es requerido.',
            'id_author.numeric' => 'Seleccione un :attribute válido.',
            'id_author.gt' => 'Seleccione un :attribute válido.',
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
            'title' => 'título',
            'lyrics_que' => 'letras en Quechua',
            'id_genre' => 'género musical',
            'id_author' => 'autor',
        ];
    }

}
