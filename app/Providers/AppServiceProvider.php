<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Website\app\Models\Category;

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
            'verify' => false,
        ]);

        $categories = Category::where('status', 'active')->orderBy('name')->get();
        View::share('categories', $categories);
    }
}
