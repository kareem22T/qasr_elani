<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function ($status, $message = "", $errors = [], $data = [], $code = 200) {
            $response = [];
            $response['status']   = $status;
            $response['message']  = trans("api." . $message);
            $response['errors']   = (is_array($errors)) ? $errors : [trans("api." . $errors)];
            if ($status) {
                $response['data'] = $data;
            }
            return $this->json($response, $code);
        });
    }
}
