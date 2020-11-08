<?php


namespace NascentAfrica\LaravelLocale\Tests;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use NascentAfrica\LaravelLocale\LaravelLocaleServiceProvider;
use Orchestra\Testbench\Dusk\TestCase;

/**
 * Class BrowserTestCase
 *
 * @package NascentAfrica\LaravelLocale\Tests
 * @author Anitche Chisom <anitchec.dev@gmail.com>
 */
class BrowserTest extends TestCase
{
    protected static $baseServeHost = '127.0.0.1';
    protected static $baseServePort = 9000;

    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelLocaleServiceProvider::class];
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function locale_is_set_to_en()
    {
        $this->browse(function ($browser) {
            $browser->visit('/locales/en')
                ->assertPathIs('/locales/en');
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function locale_is_set_to_fr()
    {
        $this->browse(function ($browser) {
            $browser->visit('/locales/fr')
                ->assertPathIs('/locales/fr');
        });
    }
}
