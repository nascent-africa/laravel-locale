# Laravel Locale

Laravel locale is a starting point to build on the laravel translation system.


## Installation

### Installing Jetstream

You may use Composer to install Laravel Locale into your new Laravel project:

```
composer require nascent-africa/laravel-locale
```

### Configuration

After installation, add the `NascentAfrica\LaravelLocale\Http\Middleware\LocaleMiddleware` to `web` route group in the kernel.php file.
 
```
    ...
    
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            ...
            NascentAfrica\LaravelLocale\Http\Middleware\LocaleMiddleware::class
        ],

        ...
    ];
```

By default, this package supports `en` and `fr` locales, but you can reset this by registering your preferred locale option in your service provider:

```php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use NascentAfrica\LaravelLocale\LaravelLocaleFacade;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LaravelLocaleFacade::setLocales([
            'en', 'fr'
        ]);
    }
}
``` 

## Usage

This package registers a `/locales/{local}` to enable you switch locales by simply making a get request passing the local you wish to switch to as a parameter.

```blade
<a href="{{ url('/locales/en') }}">{{ __('English') }}</a>

or 

<a href="{{ route('locales', 'en') }}">{{ __('English') }}</a>
```

## Vue helper

This package implements a technique by [Daiyrbek Artelov](Daiyrbek Artelov) in his [How to use Laravel translations in JS (vue) files?](https://dev.to/4unkur/how-to-use-laravel-translations-in-js-vue-files-ia) to enable the use of laravel translation in VueJs files using a nice little `__(...)` function.

You can set this up with following steps:

1. Import the module and use it with vue.

```js
import Vue from 'vue'

Vue.use(require('../../vendor/nascent-africa/laravel-locale/resources/js/locale'))
```

2. Add local scripts to your layout blade view.

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>...</head>
    <body>
        

        <script>
            window._locale = '{{ app()->getLocale() }}'
            window._translations = {!! cache('translations') !!}
        </script>

        <!-- or use the blade component -->
        <x-laravel-locale-scripts />
    </body>
</html>
```

Now you can use the `__(..)` function in your vue files like so:

```vue
<template>
    <div class="card">
        <div class="card-header">{{ __('Example Component') }}</div>
    
        <div class="card-body">
            {{ __("I'm an example component.") }}
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log(this.__('Component mounted.'))
    }
}
</script>
```

## Testing
Run the tests with:

```bash
vendor/bin/phpunit
```

## License
Laravel Locale is open-sourced software licensed under the [MIT license](https://github.com/nascent-africa/laravel-locale/blob/main/LICENSE).
