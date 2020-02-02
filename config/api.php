<?php

return [
    'autoria' => [
        'api_key' => env('API_KEY_AUTORIA','API_KEY'),
        'auto_categories_url' => env('AUTORIA_AUTO_CATEGORIES_URL','AUTO_CATEGORIES_URL'),
        'auto_marks_url' => env('AUTORIA_AUTO_MARKS_URL','AUTO_MARKS_URL'),
        'auto_models_url' => env('AUTORIA_AUTO_MODELS_URL','AUTO_MODELS_URL'),
    ],
    'bitrix' => [
        'client_id' => env('BITRIX_CLIENT_ID','CLIENT_ID'),
        'client_secret' => env('BITRIX_CLIENT_SECRET','CLIENT_SECRET'),
        'api_url' => env('BITRIX_API_URL','API_URL'),
    ]
];
