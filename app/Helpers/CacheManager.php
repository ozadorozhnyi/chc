<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheManager
{
    public static function remember($key, $callback, $minutes)
    {
        return Cache::remember($key, now()->addMinutes($minutes), $callback);
    }
}
