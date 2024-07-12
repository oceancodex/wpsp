<?php

use WPSP\Funcs;

if (!defined('DB_NAME')) {
	include Funcs::instance()->_getSitePath() . '/wp-config.php';
}

return [

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for all database work. Of course
	| you may use many connections at once using the Database library.
	|
	*/

	'default' => Funcs::env('DB_CONNECTION', true, 'mysql'),

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => [

		'mysql' => [
			'driver'         => 'mysql',
//			'url'            => Funcs::env('APP_DATABASE_URL', true),
			'host'           => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::env('DB_HOST', true, '127.0.0.1'),
			'port'           => Funcs::env('DB_PORT', true, '3306'),
			'database'       => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::env('DB_DATABASE', true),
			'username'       => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::env('DB_USERNAME', true),
			'password'       => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::env('DB_PASSWORD', true),
			'unix_socket'    => Funcs::env('APP_DB_SOCKET', true),
//			'charset'        => (defined('DB_CHARSET') && DB_CHARSET) ? DB_CHARSET : 'utf8',
//			'collation'      => (defined('DB_COLLATE') && DB_COLLATE) ? DB_COLLATE : 'utf8_unicode_ci',
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],
		'mysql_2' => [
			'driver'         => 'mysql',
//			'url'            => Funcs::env('APP_DATABASE_URL', true),
			'host'           => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::env('DB_HOST', true, '127.0.0.1'),
			'port'           => Funcs::env('DB_PORT', true, '3306'),
			'database'       => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::env('DB_DATABASE', true),
			'username'       => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::env('DB_USERNAME', true),
			'password'       => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::env('DB_PASSWORD', true),
			'unix_socket'    => Funcs::env('APP_DB_SOCKET', true),
//			'charset'        => (defined('DB_CHARSET') && DB_CHARSET) ? DB_CHARSET : 'utf8',
//			'collation'      => (defined('DB_COLLATE') && DB_COLLATE) ? DB_COLLATE : 'utf8_unicode_ci',
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],

	]
];
