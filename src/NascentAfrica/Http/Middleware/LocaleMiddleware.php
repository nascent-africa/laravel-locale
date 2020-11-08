<?php

namespace NascentAfrica\LaravelLocale\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * Class LocaleMiddleware
 *
 * @package NascentAfrica\LaravelLocale\Http\Middleware
 * @author Anitche Chisom <anitchec.dev@gmail.com>
 */
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('locale') !== App::getLocale()) {
            App::setLocale(Session::get('locale', App::getLocale()));
        }

        return $next($request);
    }
}
