<?php

return [
    'default_provider' => env('AI_DESCRIPTION_PROVIDER', 'gemini'),

    'description' => [
        'max_characters' => 1500,
        'daily_limit' => (int) env('AI_DESCRIPTION_DAILY_LIMIT', 10),
        'timeout_seconds' => (int) env('AI_DESCRIPTION_TIMEOUT_SECONDS', 30),
    ],

    'providers' => [
        'gemini' => [
            'api_key' => env('GEMINI_API_KEY', ''),
            'model' => env('GEMINI_MODEL', 'gemini-3.5-flash-lite'),
            'base_url' => env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta'),
        ],
    ],
];
