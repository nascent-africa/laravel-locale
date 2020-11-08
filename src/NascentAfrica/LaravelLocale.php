<?php

namespace NascentAfrica\LaravelLocale;

/**
 * Class LaravelLocale
 *
 * @package NascentAfrica\LaravelLocale
 * @author Anitche Chisom <anitchec.dev@gmail.com>
 */
class LaravelLocale
{
    /**
     * Locales supported
     *
     * @var array
     */
    protected $locales = ['en', 'fr'];

    /**
     * Get supported locales
     *
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * Define supported locals
     *
     * @param array $locales
     * @return LaravelLocale
     */
    public function setLocales(array $locales): LaravelLocale
    {
        $this->locales = $locales;
        return $this;
    }
}
