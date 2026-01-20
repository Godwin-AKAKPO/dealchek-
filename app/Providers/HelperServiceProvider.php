<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Charger les fichiers helpers
        $helpersPath = app_path('Helpers');
        
        if (is_dir($helpersPath)) {
            $helpers = glob($helpersPath . '/*.php');
            
            foreach ($helpers as $helper) {
                require_once $helper;
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}