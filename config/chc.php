<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Localization Support
    |--------------------------------------------------------------------------
    |
    | This configuration outlines all the supported localization settings
    | for the entire application. Each key represents a language code, and
    | its corresponding value is the associated locale for that language.
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
    | This configuration specifies seeding options for entities in the application's
    | domain area. Adjust the values based on the desired number of seeded records
    | for each entity during the database seeding process.
    |
    */

    'seeding' => [
        'posts' => 50,
        'tags' => 100,
        'tags_per_post' => 3
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Expiration Times
    |--------------------------------------------------------------------------
    |
    | This configuration sets the cache expiration time (in minutes) for
    | various types of Eloquent collections and models in your application.
    |
    | Adjust the values based on how frequently you expect the data to change.
    |
    */

    'cache-expiration-time' => [
        'posts' => [
            'collection' => 60,
            'model-item' => 60,
        ],
        'tags' => [
            'collection' => 45,
            'model-item' => 45,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Per Page Settings
    |--------------------------------------------------------------------------
    |
    | This configuration defines the default number of items to be displayed
    | per page for specific resources in your application. Adjust the values
    | accordingly based on your desired pagination settings for each resource.
    |
    */
    'per-page' => [
        'posts' => 10,
        'tags' => 10,
    ],

];
