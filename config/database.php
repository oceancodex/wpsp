<?php

use Illuminate\Support\Str;
use WPSP\Funcs;

if (!defined('DB_NAME')) {
	$wpConfig = Funcs::instance()->_getWPConfig();
}

return [

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for database operations. This is
	| the connection which will be utilized unless another connection
	| is explicitly specified when you execute a query / statement.
	|
	*/

	'default' => env('WPSP_DB_CONNECTION', 'wordpress'),

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Below are all of the database connections defined for your application.
	| An example configuration is provided for each database system which
	| is supported by Laravel. You're free to add / remove connections.
	|
	*/

	'connections' => [

		'wordpress' => [
			'driver'         => 'mariadb',
//			'url'            => env('WPSP_DB_URL'),
			'host'           => defined('DB_HOST') ? DB_HOST : ($wpConfig['DB_HOST'] ?? env('WPSP_DB_HOST', '127.0.0.1')),
			'port'           => defined('DB_PORT') ? DB_PORT : ($wpConfig['DB_PORT'] ?? env('WPSP_DB_PORT', '3306')),
			'database'       => defined('DB_NAME') ? DB_NAME : ($wpConfig['DB_NAME'] ?? env('WPSP_DB_DATABASE', 'laravel')),
			'username'       => defined('DB_USER') ? DB_USER : ($wpConfig['DB_USER'] ?? env('WPSP_DB_USERNAME', 'root')),
			'password'       => defined('DB_PASSWORD') ? DB_PASSWORD : ($wpConfig['DB_PASSWORD'] ?? env('WPSP_DB_PASSWORD', '')),
			'unix_socket'    => env('WPSP_DB_SOCKET', ''),
//			'charset'        => defined('DB_CHARSET') ? DB_CHARSET : ($wpConfig['DB_CHARSET'] ?? env('WPSP_DB_CHARSET', 'utf8mb4')),
//			'collation'      => defined('DB_COLLATE') ? DB_COLLATE : ($wpConfig['DB_COLLATE'] ?? env('WPSP_DB_COLLATE', 'utf8mb4_unicode_ci')),
			'prefix'         => 'wp_wpsp_',
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => extension_loaded('pdo_mysql') ? array_filter([
				PDO::MYSQL_ATTR_SSL_CA => env('WPSP_MYSQL_ATTR_SSL_CA'),
			]) : [],
		],

		'sqlite' => [
			'driver'                  => 'sqlite',
			'url'                     => env('WPSP_DB_URL'),
			'database'                => env('WPSP_DB_DATABASE', database_path('database.sqlite')),
			'prefix'                  => '',
			'foreign_key_constraints' => env('WPSP_DB_FOREIGN_KEYS', true),
			'busy_timeout'            => null,
			'journal_mode'            => null,
			'synchronous'             => null,
			'transaction_mode'        => 'DEFERRED',
		],

		'mysql' => [
			'driver'         => 'mysql',
			'url'            => env('WPSP_DB_URL'),
			'host'           => env('WPSP_DB_HOST', '127.0.0.1'),
			'port'           => env('WPSP_DB_PORT', '3306'),
			'database'       => env('WPSP_DB_DATABASE', 'laravel'),
			'username'       => env('WPSP_DB_USERNAME', 'root'),
			'password'       => env('WPSP_DB_PASSWORD', ''),
			'unix_socket'    => env('WPSP_DB_SOCKET', ''),
			'charset'        => env('WPSP_DB_CHARSET', 'utf8mb4'),
			'collation'      => env('WPSP_DB_COLLATION', 'utf8mb4_unicode_ci'),
			'prefix'         => '',
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => extension_loaded('pdo_mysql') ? array_filter([
				PDO::MYSQL_ATTR_SSL_CA => env('WPSP_MYSQL_ATTR_SSL_CA'),
			]) : [],
		],

		'mariadb' => [
			'driver'         => 'mariadb',
			'url'            => env('WPSP_DB_URL'),
			'host'           => env('WPSP_DB_HOST', '127.0.0.1'),
			'port'           => env('WPSP_DB_PORT', '3306'),
			'database'       => env('WPSP_DB_DATABASE', 'laravel'),
			'username'       => env('WPSP_DB_USERNAME', 'root'),
			'password'       => env('WPSP_DB_PASSWORD', ''),
			'unix_socket'    => env('WPSP_DB_SOCKET', ''),
			'charset'        => env('WPSP_DB_CHARSET', 'utf8mb4'),
			'collation'      => env('WPSP_DB_COLLATION', 'utf8mb4_unicode_ci'),
			'prefix'         => '',
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => extension_loaded('pdo_mysql') ? array_filter([
				PDO::MYSQL_ATTR_SSL_CA => env('WPSP_MYSQL_ATTR_SSL_CA'),
			]) : [],
		],

		'pgsql' => [
			'driver'         => 'pgsql',
			'url'            => env('WPSP_DB_URL'),
			'host'           => env('WPSP_DB_HOST', '127.0.0.1'),
			'port'           => env('WPSP_DB_PORT', '5432'),
			'database'       => env('WPSP_DB_DATABASE', 'laravel'),
			'username'       => env('WPSP_DB_USERNAME', 'root'),
			'password'       => env('WPSP_DB_PASSWORD', ''),
			'charset'        => env('WPSP_DB_CHARSET', 'utf8'),
			'prefix'         => '',
			'prefix_indexes' => true,
			'search_path'    => 'public',
			'sslmode'        => 'prefer',
		],

		'sqlsrv' => [
			'driver'         => 'sqlsrv',
			'url'            => env('WPSP_DB_URL'),
			'host'           => env('WPSP_DB_HOST', 'localhost'),
			'port'           => env('WPSP_DB_PORT', '1433'),
			'database'       => env('WPSP_DB_DATABASE', 'laravel'),
			'username'       => env('WPSP_DB_USERNAME', 'root'),
			'password'       => env('WPSP_DB_PASSWORD', ''),
			'charset'        => env('WPSP_DB_CHARSET', 'utf8'),
			'prefix'         => '',
			'prefix_indexes' => true,
			// 'encrypt' => env('WPSP_DB_ENCRYPT', 'yes'),
			// 'trust_server_certificate' => env('WPSP_DB_TRUST_SERVER_CERTIFICATE', 'false'),
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	|
	| This table keeps track of all the migrations that have already run for
	| your application. Using this information, we can determine which of
	| the migrations on disk haven't actually been run on the database.
	|
	*/

	'migrations' => [
		'table'                  => 'migrations',
		'update_date_on_publish' => true,
	],

	/*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	|
	| Redis is an open source, fast, and advanced key-value store that also
	| provides a richer body of commands than a typical key-value system
	| such as Memcached. You may define your connection settings here.
	|
	*/

	'redis' => [

		'client' => env('WPSP_REDIS_CLIENT', 'phpredis'),

		'options' => [
			'cluster'    => env('WPSP_REDIS_CLUSTER', 'redis'),
			'prefix'     => env('WPSP_REDIS_PREFIX', Str::slug((string)env('WPSP_APP_SHORT_NAME', 'wpsp')) . '-database-'),
			'persistent' => env('WPSP_REDIS_PERSISTENT', false),
		],

		'default' => [
			'url'               => env('WPSP_REDIS_URL'),
			'host'              => env('WPSP_REDIS_HOST', '127.0.0.1'),
			'username'          => env('WPSP_REDIS_USERNAME'),
			'password'          => env('WPSP_REDIS_PASSWORD'),
			'port'              => env('WPSP_REDIS_PORT', '6379'),
			'database'          => env('WPSP_REDIS_DB', '0'),
			'max_retries'       => env('WPSP_REDIS_MAX_RETRIES', 3),
			'backoff_algorithm' => env('WPSP_REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
			'backoff_base'      => env('WPSP_REDIS_BACKOFF_BASE', 100),
			'backoff_cap'       => env('WPSP_REDIS_BACKOFF_CAP', 1000),
		],

		'cache' => [
			'url'               => env('WPSP_REDIS_URL'),
			'host'              => env('WPSP_REDIS_HOST', '127.0.0.1'),
			'username'          => env('WPSP_REDIS_USERNAME'),
			'password'          => env('WPSP_REDIS_PASSWORD'),
			'port'              => env('WPSP_REDIS_PORT', '6379'),
			'database'          => env('WPSP_REDIS_CACHE_DB', '1'),
			'max_retries'       => env('WPSP_REDIS_MAX_RETRIES', 3),
			'backoff_algorithm' => env('WPSP_REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
			'backoff_base'      => env('WPSP_REDIS_BACKOFF_BASE', 100),
			'backoff_cap'       => env('WPSP_REDIS_BACKOFF_CAP', 1000),
		],

	],

];