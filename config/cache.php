<?php

use WPSP\Funcs;
use Illuminate\Support\Str;

return [

	/*
	|--------------------------------------------------------------------------
	| Default Cache Store
	|--------------------------------------------------------------------------
	|
	| This option controls the default cache connection that gets used while
	| using this caching library. This connection is used when another is
	| not explicitly specified when executing a given caching function.
	|
	*/

	'default' => Funcs::env('CACHE_STORE', true, 'database'),

	/*
	|--------------------------------------------------------------------------
	| Rate limiter
	|--------------------------------------------------------------------------
	|
	*/

	'rate_limiter' => Funcs::env('RATE_LIMITER_STORE', true, 'database'),

	/*
	|--------------------------------------------------------------------------
	| Cache Stores
	|--------------------------------------------------------------------------
	|
	| Here you may define all the cache "stores" for your application as
	| well as their drivers. You may even define multiple stores for the
	| same cache driver to group types of items stored in your caches.
	|
	| Supported drivers: "apc", "array", "database", "file",
	|         "memcached", "redis", "dynamodb", "octane", "null"
	|
	*/

	'stores' => [

		'database' => [
			'dbname'   => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::env('DB_DATABASE', true),
			'user'     => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::env('DB_USERNAME', true),
			'password' => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::env('DB_PASSWORD', true),
			'host'     => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::env('DB_HOST', true),
			'driver'   => 'pdo_mysql',
		],

		'file' => [
			'driver'    => 'file',
			'path'      => Funcs::instance()->_getStoragePath('/framework/cache/data'),
			'lock_path' => Funcs::instance()->_getStoragePath('/framework/cache/data'),
		],

		'memcached' => [
			'driver' => 'memcached',
			'persistent_id' => Funcs::env('MEMCACHED_PERSISTENT_ID', true),
			'sasl' => [
				Funcs::env('MEMCACHED_USERNAME', true),
				Funcs::env('MEMCACHED_PASSWORD', true),
			],
			'options' => [
				// Memcached::OPT_CONNECT_TIMEOUT => 2000,
			],
			'servers' => [
				[
					'host'   => Funcs::env('MEMCACHED_HOST', true, '127.0.0.1'),
					'port'   => Funcs::env('MEMCACHED_PORT', true, 11211),
					'weight' => 100,
				],
			],
		],

		'redis' => [
			'driver'   => 'redis',
			'host'     => Funcs::env('REDIS_HOST', true, '127.0.0.1'),
			'port'     => Funcs::env('REDIS_PORT', true, 6379),
			'user'     => Funcs::env('REDIS_USER', true),
			'password' => Funcs::env('REDIS_PASSWORD', true),
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Cache Key Prefix
	|--------------------------------------------------------------------------
	|
	| When utilizing a RAM based store such as APC or Memcached, there might
	| be other applications utilizing the same cache. So, we'll specify a
	| value to get prefixed to all our keys, so we can avoid collisions.
	|
	*/

	'prefix' => Funcs::env('CACHE_PREFIX', true, Str::slug(Funcs::env('APP_SHORT_NAME', true)) . '-cache'),

];
