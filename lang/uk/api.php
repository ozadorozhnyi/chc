<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Translation strings related to the api.
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used
    | inside api responses.
    |
    */

    'not_found_http_exception' => [
        'title' => 'Ресурс не знайдено.',
        'message' => 'Запитаний ресурс не може бути знайдений.',
    ],
    'language_not_supported_exception' => [
        'title' => 'Мова не підтримується.',
        'message' => 'Запитана мова :language не підтримується.',
    ],
    'validation_exception_title' => 'Некоректний запит',
    'resource_creation_failed' => [
        'title' => 'Не вдалося створити ресурс',
        'message' => 'Виникла проблема при спробі створення ресурсу. Будь ласка, спробуйте знову пізніше.',
    ],
    'attributes' => [
        'post' => [
            'title' => 'Заголовок повідомлення',
            'description' => 'Опис повідомлення',
            'content' => 'Зміст повідомлення',
        ],
    ],
];
