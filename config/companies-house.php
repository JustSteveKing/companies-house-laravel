<?php

return [
    'api' => [
        'key' => env('COMPANIES_HOUSE_KEY', ''),
        'url' => env('COMPANIES_HOUSE_URL', 'https://api.company-information.service.gov.uk'),
        'timeout' => env('COMPANIES_HOUSE_TIMEOUT', 10),
        'retry' => [
            'times' => env('COMPANIES_HOUSE_RETRY_TIMES', null),
            'milliseconds' => env('COMPANIES_HOUSE_RETRY_MILLISECONDS', null),
        ],
    ]
];
