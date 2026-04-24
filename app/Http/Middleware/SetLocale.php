<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported public locales.
     *
     * @var array<int, string>
     */
    private array $supportedLocales = ['en', 'es'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale', 'en'));

        if (! in_array($locale, $this->supportedLocales, true)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
