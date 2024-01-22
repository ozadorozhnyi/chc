<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait Localization
{
    /**
     * Scope a query to include translations for the current locale.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCurrentLocale(Builder $query)
    {
        return $query->with(['translations' => function ($query) {
            $query->whereHas('language', function ($query) {
                $query->where('locale', app()->getLocale());
            });
        }]);
    }

    /**
     * Scope a query to include translations for a specific locale.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithLocale(Builder $query, $locale)
    {
        return $query->with('translations', function ($query) use ($locale) {
            $query->whereHas('language', function ($query) use ($locale) {
                $query->where('locale', $locale);
            });
        });
    }

    /**
     * Scope a query to include translations for multiple locales.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $locales
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithLocales(Builder $query, $locales)
    {
        return $query->with('translations', function ($query) use ($locales) {
            $query->whereHas('language', function ($query) use ($locales) {
                $query->whereIn('locale', $locales);
            });
        });
    }
}

