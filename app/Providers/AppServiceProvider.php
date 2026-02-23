<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        // 1. Fix the syntax errors (removed backslashes)
        // 2. Only apply these forces in production to avoid local development issues
        if ($this->app->environment('production')) {
            
            // Forces all generated links (route(), asset(), etc.) to use HTTPS
            URL::forceScheme('https');

            // Forces the root URL to match 'APP_URL' from your .env file
            if (config('app.url')) {
                URL::forceRootUrl(config('app.url'));
            }
        }
    }
}