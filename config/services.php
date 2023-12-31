<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'http://example.com/callback-url',
    ],

    'facebook' => [
        'client_id' => '1378376456063007',
        'client_secret' =>'edae8a06eb083cf0f58384df9f91e78d',
        'redirect' => '/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '570067194154-32to4ff8g9qosv7053oij0l5oa4um6nd.apps.googleusercontent.com',
        'client_secret' =>'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',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
    ],

];
