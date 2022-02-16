<?php

declare(strict_types=1);

return [
    /*
     * A valid Treblle API key. You can get started for FREE by visiting https://treblle.com/
     */
    'api_key' => env('TREBLLE_API_KEY'),

    /*
     * A valid Treblle project ID. Create your first project on https://treblle.com/
     */
    'project_id' => env('TREBLLE_PROJECT_ID'),

    /*
     * Define which environments should Treblle ignore and not monitor
     */
    'ignored_environments' => env('TREBLLE_IGNORED_ENV', 'dev,test'),

    /*
     * Define which fields should be masked before leaving the server
     */
    'masked_fields' => [
        'password',
        'pwd',
        'secret',
        'password_confirmation',
        'cc',
        'card_number',
        'ccv',
        'ssn',
        'credit_score',
        'api_key',
        'token',
    ],
];
