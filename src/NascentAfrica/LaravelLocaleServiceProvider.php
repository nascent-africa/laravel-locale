<?php

namespace NascentAfrica\LaravelLocale;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use NascentAfrica\LaravelLocale\Http\Middleware\LocaleMiddleware;

/**
 * Class LaravelLocaleServiceProvider
 *
 * @package NascentAfrica\LaravelLocale
 * @author Anitche Chisom <anitchec.dev@gmail.com>
 */
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
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'laravel-locale');
        $this->configureRoutes();
        $this->configureComponents();
        $this->cacheTranslation();

        if ($this->app->runningInConsole()) {
            // Publishing the views.
            $this->publishes([
                __DIR__.'/../../resources/views' => resource_path('views/vendor/laravel-locale'),
            ], 'views');
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

    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('scripts');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('laravel-locale::components.'.$component, 'laravel-locale-'.$component);
    }

    /**
     * Configure the routes offered by the application.
     *
     * @return void
     */
    protected function configureRoutes()
    {
        Route::group([
            'middleware' => ['web', LocaleMiddleware::class],
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });
    }

    private function cacheTranslation()
    {
        Cache::rememberForever('translations', function () {
            $translations = collect();

            foreach (LaravelLocaleFacade::getLocales() as $locale) { // supported locales
                $translations[$locale] = [
                    'php' => $this->phpTranslations($locale),
                    'json' => $this->jsonTranslations($locale),
                ];
            }

            return $translations;
        });
    }

    /**
     * @param $locale
     * @return array|\Illuminate\Support\Collection
     */
    private function phpTranslations($locale)
    {
        $path = resource_path("lang/$locale");

        if (! (new Filesystem)->isDirectory($path))
            return [];

        return collect(File::allFiles($path))->flatMap(function ($file) use ($locale) {
            $key = ($translation = $file->getBasename('.php'));

            return [$key => trans($translation, [], $locale)];
        });
    }

    /**
     * @param $locale
     * @return array|mixed
     */
    private function jsonTranslations($locale)
    {
        $path = resource_path("lang/$locale.json");

        if (! (new Filesystem)->isFile($path))
            return [];

        if (is_string($path) && is_readable($path)) {
            return json_decode(file_get_contents($path), true);
        }

        return [];
    }
}
