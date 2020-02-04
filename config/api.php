<?php

return [
    'autoria' => [
        'api_key' => env('API_KEY_AUTORIA', 'API_KEY'),
        'auto_categories_url' => env('AUTORIA_AUTO_CATEGORIES_URL', 'AUTO_CATEGORIES_URL'),
        'auto_marks_url' => env('AUTORIA_AUTO_MARKS_URL', 'AUTO_MARKS_URL'),
        'auto_models_url' => env('AUTORIA_AUTO_MODELS_URL', 'AUTO_MODELS_URL'),
    ],
    'bitrix' => [
        'incomeHookUrl' => env('BITRIX_INCOME_HOOK_URL', 'INCOME_HOOK_URL'),
        'methods' => [
            'addLead' => 'crm.lead.add.json',
            'deleteLead' => 'crm.lead.delete.json'
        ]
    ]
];
