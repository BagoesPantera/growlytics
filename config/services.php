<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'growlytics' => [
        'stream_url' => env('GROWLYTICS_STREAM_URL'),
        'connect_timeout' => env('GROWLYTICS_STREAM_CONNECT_TIMEOUT', 15),
        'read_timeout' => env('GROWLYTICS_STREAM_READ_TIMEOUT', 60),
        'retry_delay' => env('GROWLYTICS_STREAM_RETRY_DELAY', 5),
        'max_retry_delay' => env('GROWLYTICS_STREAM_MAX_RETRY_DELAY', 60),
        'max_event_size' => env('GROWLYTICS_STREAM_MAX_EVENT_SIZE', 65536),
    ],

];
