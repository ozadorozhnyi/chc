<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | App Localization Support
    |--------------------------------------------------------------------------
    |
    | Describes all localization settings, supported by the entire application.
    |
    */

    'l18n' => [
        'en' => 'en_US',
        'uk' => 'uk_UA',
        'es' => 'es_ES',
    ],

    /*
    |--------------------------------------------------------------------------
    | Seeding Options
    |--------------------------------------------------------------------------
    |
    | Defines seeding options for the application domain area entities.
    |
    */

    'seeding' => [
        'posts' => 10,
        'tags' => 50,
        'tags_per_post' => 3
    ],

];
