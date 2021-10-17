<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function ($data = null, $status = 200, $code = null, $message = null) {
            return Response::make([
                'code' => is_null($code) ? Config::get('api.codes.ok') : $code,
                'message' => is_null($message) ? Config::get('api.messages.ok') : $message,
                'data' => $data
            ], $status);
        });
    }
}
