<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Reverb Server
    |--------------------------------------------------------------------------
    |
    | This option controls the default server used by Reverb to handle
    | incoming messages as well as broadcasting message to all your
    | connected clients. At this time only "reverb" is supported.
    |
    */

    'default' => env('WPSP_REVERB_SERVER', 'reverb'),

    /*
    |--------------------------------------------------------------------------
    | Reverb Servers
    |--------------------------------------------------------------------------
    |
    | Here you may define details for each of the supported Reverb servers.
    | Each server has its own configuration options that are defined in
    | the array below. You should ensure all the options are present.
    |
    */

    'servers' => [

        'reverb' => [
            'host' => env('WPSP_REVERB_SERVER_HOST', '0.0.0.0'),
            'port' => env('WPSP_REVERB_SERVER_PORT', 8080),
            'path' => env('WPSP_REVERB_SERVER_PATH', ''),
            'hostname' => env('WPSP_REVERB_HOST'),
            'options' => [
                'tls' => [],
            ],
            'max_request_size' => env('WPSP_REVERB_MAX_REQUEST_SIZE', 10_000),
            'scaling' => [
                'enabled' => env('WPSP_REVERB_SCALING_ENABLED', false),
                'channel' => env('WPSP_REVERB_SCALING_CHANNEL', 'reverb'),
                'server' => [
                    'url' => env('WPSP_REDIS_URL'),
                    'host' => env('WPSP_REDIS_HOST', '127.0.0.1'),
                    'port' => env('WPSP_REDIS_PORT', '6379'),
                    'username' => env('WPSP_REDIS_USERNAME'),
                    'password' => env('WPSP_REDIS_PASSWORD'),
                    'database' => env('WPSP_REDIS_DB', '0'),
                    'timeout' => env('WPSP_REDIS_TIMEOUT', 60),
                ],
            ],
            'pulse_ingest_interval' => env('WPSP_REVERB_PULSE_INGEST_INTERVAL', 15),
            'telescope_ingest_interval' => env('WPSP_REVERB_TELESCOPE_INGEST_INTERVAL', 15),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Reverb Applications
    |--------------------------------------------------------------------------
    |
    | Here you may define how Reverb applications are managed. If you choose
    | to use the "config" provider, you may define an array of apps which
    | your server will support, including their connection credentials.
    |
    */

    'apps' => [

        'provider' => 'config',

        'apps' => [
            [
                'key' => env('WPSP_REVERB_APP_KEY'),
                'secret' => env('WPSP_REVERB_APP_SECRET'),
                'app_id' => env('WPSP_REVERB_APP_ID'),
                'options' => [
                    'host' => env('WPSP_REVERB_HOST'),
                    'port' => env('WPSP_REVERB_PORT', 443),
                    'scheme' => env('WPSP_REVERB_SCHEME', 'https'),
                    'useTLS' => env('WPSP_REVERB_SCHEME', 'https') === 'https',
                ],
                'allowed_origins' => ['*'],
                'ping_interval' => env('WPSP_REVERB_APP_PING_INTERVAL', 60),
                'activity_timeout' => env('WPSP_REVERB_APP_ACTIVITY_TIMEOUT', 30),
                'max_connections' => env('WPSP_REVERB_APP_MAX_CONNECTIONS'),
                'max_message_size' => env('WPSP_REVERB_APP_MAX_MESSAGE_SIZE', 10_000),
                'accept_client_events_from' => env('WPSP_REVERB_APP_ACCEPT_CLIENT_EVENTS_FROM', 'members'),
                'rate_limiting' => [
                    'enabled' => env('WPSP_REVERB_APP_RATE_LIMITING_ENABLED', false),
                    'max_attempts' => env('WPSP_REVERB_APP_RATE_LIMIT_MAX_ATTEMPTS', 60),
                    'decay_seconds' => env('WPSP_REVERB_APP_RATE_LIMIT_DECAY_SECONDS', 60),
                    'terminate_on_limit' => env('WPSP_REVERB_APP_RATE_LIMIT_TERMINATE', false),
                ],
            ],
        ],

    ],

];
