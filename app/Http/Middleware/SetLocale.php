<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locales = ['en', 'fr', 'ar'];

        if ($request->has('lang') && in_array($request->lang, $locales)) {
            Session::put('locale', $request->lang);
        }

        $locale = Session::get('locale', config('app.locale'));

        if (in_array($locale, $locales)) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
