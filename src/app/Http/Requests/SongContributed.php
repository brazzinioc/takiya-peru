<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\GoogleApi;

class SongContributed extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(! env('APP_DEBUG') ){ //validación sólo en Producción
            //Valida Google Recaptcha. Si no es válido, setea a NULL el campo recaptcha_token
            if(! GoogleApi::validateGoogleRecaptcha( $this->request->get('recaptcha_token') )){
                $this->request->set('recaptcha_token', null);
            }
        }

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
            "title" => "required",
            "lyrics_que" => "required",
            "lyrics_spn" => "required",
            "audio_video_url" => "required|url",
            "music_genre" => "required",
            "author" => "required",
            "email_translater" => "nullable|email",
            "recaptcha_token" => "required"
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
            'title.required' => 'El :attribute es requerido',
            'lyrics_que.required' => ':attribute es requerido',
            'lyrics_spn.required' => ':attribute es requerido',
            'audio_video_url.required' => ':attribute es requerido',
            'audio_video_url.url' => 'Ingresa un URL válido',
            'music_genre.required' => 'El :attribute es requerido',
            'author.required' => 'El :attribute es requerido',
            'email_translater.required' => 'El :attribute es requerido',
            'email_translater.email' => 'Ingresa un correo válido.',
            'recaptcha_token.required' => ':attribute inválido',
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
            'title' => 'título de la canción',
            'lyrics_que' => 'Letras en Quechua',
            'lyrics_spn' => 'Letras en Español',
            'audio_video_url' => 'URL de audio/video de la canción',
            'music_genre' => 'género musical',
            'author' => 'autor de la canción',
            'email_translater' => 'correo de traductor',
            'recaptcha_token' => 'Google Recaptcha'
        ];
    }
}
