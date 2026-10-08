<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "reverb", "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => env('WPSP_BROADCAST_CONNECTION', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over WebSockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'reverb' => [
            'driver' => 'reverb',
            'key' => env('WPSP_REVERB_APP_KEY'),
            'secret' => env('WPSP_REVERB_APP_SECRET'),
            'app_id' => env('WPSP_REVERB_APP_ID'),
            'options' => [
                'host' => env('WPSP_REVERB_HOST'),
                'port' => env('WPSP_REVERB_PORT', 443),
                'scheme' => env('WPSP_REVERB_SCHEME', 'https'),
                'useTLS' => env('WPSP_REVERB_SCHEME', 'https') === 'https',
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('WPSP_PUSHER_APP_KEY'),
            'secret' => env('WPSP_PUSHER_APP_SECRET'),
            'app_id' => env('WPSP_PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('WPSP_PUSHER_APP_CLUSTER'),
                'host' => env('WPSP_PUSHER_HOST') ?: 'api-'.env('WPSP_PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'port' => env('WPSP_PUSHER_PORT', 443),
                'scheme' => env('WPSP_PUSHER_SCHEME', 'https'),
                'encrypted' => true,
                'useTLS' => env('WPSP_PUSHER_SCHEME', 'https') === 'https',
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('WPSP_ABLY_KEY'),
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
