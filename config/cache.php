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

	'default' => Funcs::instance()->env('CACHE_DRIVER', true, 'database'),

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
			'dbname'   => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::instance()->env('DB_DATABASE', true),
			'user'     => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::instance()->env('DB_USERNAME', true),
			'password' => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::instance()->env('DB_PASSWORD', true),
			'host'     => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::instance()->env('DB_HOST', true),
			'driver'   => 'pdo_mysql',
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

	'prefix' => Funcs::instance()->env('CACHE_PREFIX', true, Str::slug(Funcs::instance()->env('APP_SHORT_NAME', true)) . '-cache'),

];
