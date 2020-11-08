<?php

use Illuminate\Support\Facades\Route;
use NascentAfrica\LaravelLocale\Http\Controllers\LocaleController;

// Locale route...
Route::get('/locales/{locale}', [LocaleController::class, '__invoke'])->name('locale');
