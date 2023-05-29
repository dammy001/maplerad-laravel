<?php

return [
    /*
        |--------------------------------------------------------------------------
        | Maplerad API Key
        |--------------------------------------------------------------------------
        |
        | The Maplerad API key give you access to Maplerad's API. The "secret_key" is
        | typically used to make a request to the API.
        |
        */

    'secret_key' => env('MAPLERAD_SECRET_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    |
    | This is the domain where the apis will be accessible from.
    |
    */

    'domain' => env('MAPLERAD_DOMAIN', 'https://api.maplerad.com/v1/'),

    /*
    |--------------------------------------------------------------------------
    | Maplerad Webhooks
    |--------------------------------------------------------------------------
    |
    | Your Maplerad webhook secret is used to prevent unauthorized requests to
    | your Maplerad webhook handling controllers. The tolerance setting will
    | check the drift between the current time and the signed request's.
    |
    */

    'webhook' => [
        'secret' => env('MAPLERAD_WEBHOOK_SECRET'),
        'tolerance' => env('MAPLERAD_WEBHOOK_TOLERANCE', 300),
        'events' => [],
    ],

    'locale' => 'en'
];
