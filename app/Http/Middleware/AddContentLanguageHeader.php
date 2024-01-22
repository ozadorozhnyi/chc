<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\LocaleHelper;
use Symfony\Component\HttpFoundation\Response;

class AddContentLanguageHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->header('Content-Language', LocaleHelper::getAvailableLocales());

        return $response;
    }
}
