<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * Get available locales for the application.
     *
     * @return string
     */
    public static function getAvailableLocales(): string
    {
        return \implode(',', \array_keys(config('chc.l18n')));
    }
}
