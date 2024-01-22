<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\LanguageNotSupportedException;

class Localization
{
    /**
     * Http header with localization information.
     */
    private const EXTRACT_FROM_HEADER = 'Accept-Language';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header(self::EXTRACT_FROM_HEADER);

        $available = \array_keys(config('chc.l18n'));

        if (! \in_array($locale, $available, true)) {
            throw new LanguageNotSupportedException($locale);
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
