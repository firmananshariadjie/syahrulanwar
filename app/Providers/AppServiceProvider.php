<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $publicPath = base_path('public');
        App::bind('path.public', function () use ($publicPath) {
            return $publicPath;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \DB::listen(function ($query) {
            Log::info($query->sql, $query->bindings);
        });
    }
    
}
