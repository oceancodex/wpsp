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

	'default' => Funcs::env('DB_CONNECTION', true, 'wpsp_wordpress'),

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
	| --------------------------------------------------------------------------
	| !!! ATTENTION: All connection keys must be started with a "wpsp_" prefix. !!!
	| --------------------------------------------------------------------------
	|
	*/

	'connections' => [

		'wpsp_wordpress' => [
			'driver'         => 'mariadb',
//			'url'            => Funcs::env('DATABASE_URL', true),
			'host'           => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::env('DB_HOST', true, '127.0.0.1'),
			'port'           => Funcs::env('DB_PORT', true, '3306'),
			'database'       => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::env('DB_DATABASE', true),
			'username'       => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::env('DB_USERNAME', true),
			'password'       => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::env('DB_PASSWORD', true),
			'unix_socket'    => Funcs::env('DB_SOCKET', true),
//			'charset'        => (defined('DB_CHARSET') && DB_CHARSET) ? DB_CHARSET : 'utf8mb4',
//			'collation'      => (defined('DB_COLLATE') && DB_COLLATE) ? DB_COLLATE : 'utf8mb4_unicode_ci',
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],

		'wpsp_mysql' => [
			'driver'         => 'mysql',
			'url'            => Funcs::env('DB_MYSQL_URL', true),
			'host'           => Funcs::env('DB_MYSQL_HOST', true, '127.0.0.1'),
			'port'           => Funcs::env('DB_MYSQL_PORT', true, '3306'),
			'database'       => Funcs::env('DB_MYSQL_DATABASE', true),
			'username'       => Funcs::env('DB_MYSQL_USERNAME', true),
			'password'       => Funcs::env('DB_MYSQL_PASSWORD', true),
			'unix_socket'    => Funcs::env('DB_MYSQL_SOCKET', true),
			'charset'        => Funcs::env('DB_MYSQL_CHARSET', true, 'utf8mb4'),
			'collation'      => Funcs::env('DB_MYSQL_COLLATE', true, 'utf8mb4_unicode_ci'),
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],

		'wpsp_mariadb' => [
			'driver'         => 'mariadb',
			'url'            => Funcs::env('DB_MARIADB_URL', true),
			'host'           => Funcs::env('DB_MARIADB_HOST', true, '127.0.0.1'),
			'port'           => Funcs::env('DB_MARIADB_PORT', true, '3306'),
			'database'       => Funcs::env('DB_MARIADB_DATABASE', true),
			'username'       => Funcs::env('DB_MARIADB_USERNAME', true),
			'password'       => Funcs::env('DB_MARIADB_PASSWORD', true),
			'unix_socket'    => Funcs::env('DB_MARIADB_SOCKET', true),
			'charset'        => Funcs::env('DB_MARIADB_CHARSET', true, 'utf8mb4'),
			'collation'      => Funcs::env('DB_MARIADB_COLLATE', true, 'utf8mb4_unicode_ci'),
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],

		'wpsp_mongodb' => [
			'driver'   => 'mongodb',
			'host'     => Funcs::env('DB_MONGODB_HOST', true, 'localhost'),
			'port'     => Funcs::env('DB_MONGODB_PORT', true, 27017),
			'database' => Funcs::env('DB_MONGODB_DATABASE', true, 'wpsp_mongodb_database'),
			'username' => Funcs::env('DB_MONGODB_USERNAME', true),
			'password' => Funcs::env('DB_MONGODB_PASSWORD', true),
			'options'  => [
				'database' => Funcs::env('DB_MONGODB_AUTHENTICATION_DATABASE', true, 'admin'),
			],
		],

		'wpsp_sqlite' => [
			'driver'                  => 'sqlite',
			'url'                     => Funcs::env('DB_SQLITE_URL', true),
			'database'                => Funcs::env('DB_SQLITE_DATABASE', true, 'wpsp_sqlite_database'),
			'prefix'                  => Funcs::instance()->_getDBTablePrefix(),
			'foreign_key_constraints' => Funcs::env('DB_SQLITE_FOREIGN_KEYS', true, true),
		],

		'wpsp_pgsql' => [
			'driver'         => 'pgsql',
			'url'            => Funcs::env('DB_PGSQL_URL', true),
			'host'           => Funcs::env('DB_PGSQL_HOST', true, '127.0.0.1'),
			'port'           => Funcs::env('DB_PGSQL_PORT', true, '5432'),
			'database'       => Funcs::env('DB_PGSQL_DATABASE', true, 'wpsp_pgsql_database'),
			'username'       => Funcs::env('DB_PGSQL_USERNAME', true, 'root'),
			'password'       => Funcs::env('DB_PGSQL_PASSWORD', true, ''),
			'charset'        => Funcs::env('DB_PGSQL_CHARSET', true, 'utf8'),
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			'search_path'    => 'public',
			'sslmode'        => 'prefer',
		],

		'wpsp_sqlsrv' => [
			'driver'         => 'sqlsrv',
			'url'            => Funcs::env('DB_SQLSRV_URL'),
			'host'           => Funcs::env('DB_SQLSRV_HOST', 'localhost'),
			'port'           => Funcs::env('DB_SQLSRV_PORT', '1433'),
			'database'       => Funcs::env('DB_SQLSRV_DATABASE', 'wpsp_sqlsrv_database'),
			'username'       => Funcs::env('DB_SQLSRV_USERNAME', 'root'),
			'password'       => Funcs::env('DB_SQLSRV_PASSWORD', ''),
			'charset'        => Funcs::env('DB_SQLSRV_CHARSET', 'utf8'),
			'prefix'         => Funcs::instance()->_getDBTablePrefix(),
			'prefix_indexes' => true,
			// 'encrypt' => env('DB_ENCRYPT', 'yes'),
			// 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
		],

	]
];
