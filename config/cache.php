<?php

use OCBPCORE\Objects\Env;
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

	'default' => env('CACHE_DRIVER', 'database'),

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
			'dbname'   => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Env::get('DB_DATABASE'),
			'user'     => (defined('DB_USER') && DB_USER) ? DB_USER : Env::get('DB_USERNAME'),
			'password' => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Env::get('DB_PASSWORD'),
			'host'     => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Env::get('DB_HOST'),
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

	'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_SHORT_NAME')) . '-cache'),

];
