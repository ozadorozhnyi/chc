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
        'title' => 'Recurso no encontrado.',
        'message' => 'No se pudo encontrar el recurso solicitado.',
    ],
    'language_not_supported_exception' => [
        'title' => 'Idioma no compatible.',
        'message' => 'El idioma solicitado :language no es compatible.',
    ],
    'validation_exception_title' => 'Entidad no procesable',
    'resource_creation_failed' => [
        'title' => 'Fallo en la creación del recurso',
        'message' => 'Se ha producido un problema al intentar crear el recurso. Por favor, inténtelo de nuevo más tarde.',
    ],
    'attributes' => [
        'post' => [
            'title' => 'Título de la publicación',
            'description' => 'Descripción de la publicación',
            'content' => 'Contenido de la publicación',
        ],
    ],
];
