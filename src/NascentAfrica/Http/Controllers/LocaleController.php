<?php

namespace NascentAfrica\LaravelLocale\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use NascentAfrica\LaravelLocale\LaravelLocaleFacade as LaravelLocale;

/**
 * Class LocaleController
 *
 * @package NascentAfrica\LaravelLocale\Http\Controllers
 * @author Anitche Chisom <anitchec.dev@gmail.com>
 */
class LocaleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Handle change local request
     *
     * @param Request $request
     * @param string $locale
     * @return JsonResponse|RedirectResponse
     */
    public function __invoke(Request $request, string $locale)
    {
        if (! in_array($locale, LaravelLocale::getLocales()))
            abort(404);

        $request->session()->put('locale', $locale);

        return $request->wantsJson()
            ? response()->json(['locale' => $locale])
            : redirect()->back();
    }
}
