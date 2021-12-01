<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class GoogleApi extends Model
{
    public static function validateGoogleRecaptcha($recaptchaToken = null) : bool
    {
        $result = FALSE;

        if($recaptchaToken){
            try {

                $client = new Client([
                    'base_uri' => config('app.recaptcha_base_url'), //env('RECAPTCHA_BASE_URL'),
                    'timeout'  => 2.0,
                ]);

                //Envía token al API de Google - Recaptcha v3
                $apiResponse = $client->request('POST', config('app.recaptcha_url_verify'), /*env('RECAPTCHA_URL_VERIFY')*/ [
                    'form_params' => [
                        'secret' => config('app.recaptcha_secret_key'), /*env('GOOGLE_RECAPTCHA_SECRET_KEY'),*/
                        'response' => $recaptchaToken
                    ]
                ]);

                if(intval($apiResponse->getStatusCode()) == 200){
                    $response = $apiResponse->getBody();

                    if(strlen($response)){
                        $response = json_decode($response, true); //convert json to array assocc

                        if( $response['success']){
                            $result = TRUE;
                        }

                    }
                }

            } catch(\Exception $e){
                Log::alert("Error in recaptcha verification. " . $e->getMessage());
            }
        }

        return $result;
    }
}
