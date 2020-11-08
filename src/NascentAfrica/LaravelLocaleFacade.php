<?php

namespace NascentAfrica\LaravelLocale;

use Illuminate\Support\Facades\Facade;


/**
 * @method static array getLocales()
 * @method static array setLocales(array $locales)
 *
 * @see \NascentAfrica\LaravelLocale\LaravelLocale
 * @author Anitche Chisom <anitchec.dev@gmail.com>
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
