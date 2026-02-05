<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */

	'default' => env('WPSP_CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "array", "database", "file", "memcached",
    |                    "redis", "dynamodb", "octane",
    |                    "failover", "null"
    |
    */

	'stores' => [

		'array' => [
			'driver' => 'array',
			'serialize' => false,
		],

		'database' => [
			'driver' => 'database',
			'connection' => env('WPSP_DB_CACHE_CONNECTION'),
			'table' => env('WPSP_DB_CACHE_TABLE', 'cache'),
			'lock_connection' => env('WPSP_DB_CACHE_LOCK_CONNECTION'),
			'lock_table' => env('WPSP_DB_CACHE_LOCK_TABLE'),
		],

		'file' => [
			'driver' => 'file',
			'path' => storage_path('framework/cache/data'),
			'lock_path' => storage_path('framework/cache/data'),
		],

		'memcached' => [
			'driver' => 'memcached',
			'persistent_id' => env('WPSP_MEMCACHED_PERSISTENT_ID'),
			'sasl' => [
				env('WPSP_MEMCACHED_USERNAME'),
				env('WPSP_MEMCACHED_PASSWORD'),
			],
			'options' => [
				// Memcached::OPT_CONNECT_TIMEOUT => 2000,
			],
			'servers' => [
				[
					'host' => env('WPSP_MEMCACHED_HOST', '127.0.0.1'),
					'port' => env('WPSP_MEMCACHED_PORT', 11211),
					'weight' => 100,
				],
			],
		],

		'redis' => [
			'driver' => 'redis',
			'connection' => env('WPSP_REDIS_CACHE_CONNECTION', 'cache'),
			'lock_connection' => env('WPSP_REDIS_CACHE_LOCK_CONNECTION', 'default'),
		],

		'dynamodb' => [
			'driver' => 'dynamodb',
			'key' => env('WPSP_AWS_ACCESS_KEY_ID'),
			'secret' => env('WPSP_AWS_SECRET_ACCESS_KEY'),
			'region' => env('WPSP_AWS_DEFAULT_REGION', 'us-east-1'),
			'table' => env('WPSP_DYNAMODB_CACHE_TABLE', 'cache'),
			'endpoint' => env('WPSP_DYNAMODB_ENDPOINT'),
		],

		'octane' => [
			'driver' => 'octane',
		],

		'failover' => [
			'driver' => 'failover',
			'stores' => [
				'database',
				'array',
			],
		],

	],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing the APC, database, memcached, Redis, and DynamoDB cache
    | stores, there might be other applications using the same cache. For
    | that reason, you may prefix every cache key to avoid collisions.
    |
    */

	'prefix' => env('WPSP_CACHE_PREFIX', Str::slug((string) env('WPSP_APP_SHORT_NAME', 'wpsp')).'-cache-'),

];