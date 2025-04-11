<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $client = new Client(['verify' => false]);
        $this->app->instance('guzzle', $client);
        \Illuminate\Support\Facades\Http::withOptions([
            'verify' => false
        ]);
    }
}
