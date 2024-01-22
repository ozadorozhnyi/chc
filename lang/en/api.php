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
        'title' => 'Resource Not Found.',
        'message' => 'The requested resource could not be found.',
    ],
    'language_not_supported_exception' => [
        'title' => 'Language Not Supported.',
        'message' => 'The requested language :language is not supported.',
    ],
    'validation_exception_title' => 'Unprocessable Entity',
    'resource_creation_failed' => [
        'title' => 'Resource Creation Failed',
        'message' => 'We encountered an issue while attempting to create the resource. Please try again later.',
    ],
    'attributes' => [
        'post' => [
            'title' => 'Post Title',
            'description' => 'Post Description',
            'content' => 'Post Content',
        ],
    ],
];
