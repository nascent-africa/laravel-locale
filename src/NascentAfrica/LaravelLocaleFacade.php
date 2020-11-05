<?php

namespace NascentAfrica\LaravelLocale;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NascentAfrica\LaravelLocale\Skeleton\SkeletonClass
 */
class LaravelLocaleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-locale';
    }
}
