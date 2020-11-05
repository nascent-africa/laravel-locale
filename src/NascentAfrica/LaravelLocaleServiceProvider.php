<?php

namespace NascentAfrica\LaravelLocale;

use Illuminate\Support\ServiceProvider;

class LaravelLocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
         $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-locale');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-locale');
         $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        if ($this->app->runningInConsole()) {

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/laravel-locale'),
            ], 'views');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../../resources/lang' => resource_path('lang/vendor/laravel-locale'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('laravel-locale', function () {
            return new LaravelLocale;
        });
    }
}
