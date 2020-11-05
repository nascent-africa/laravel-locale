<?php

namespace NascentAfrica\LaravelLocale\Tests;

use Orchestra\Testbench\TestCase;
use NascentAfrica\LaravelLocale\LaravelLocaleServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelLocaleServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
