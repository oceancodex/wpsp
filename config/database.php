<?php
global $wpdb;

return [
	'default'     => env('DB_CONNECTION', 'mysql'),
	'connections' => [
		'mysql' => [
			'driver'         => 'mysql',
//			'url'            => env('APP_DATABASE_URL'),
			'host'           => (defined('DB_HOST') && DB_HOST) ? DB_HOST : env('DB_HOST', '127.0.0.1'),
			'port'           => env('DB_PORT', '3306'),
			'database'       => (defined('DB_NAME') && DB_NAME) ? DB_NAME : env('DB_DATABASE'),
			'username'       => (defined('DB_USER') && DB_USER) ? DB_USER : env('DB_USERNAME'),
			'password'       => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : env('DB_PASSWORD'),
			'unix_socket'    => env('APP_DB_SOCKET'),
//          'charset'        => (defined('DB_CHARSET') && DB_CHARSET) ? DB_CHARSET : 'utf8',
//          'collation'      => (defined('DB_COLLATE') && DB_COLLATE) ? DB_COLLATE : 'utf8_unicode_ci',
			'prefix'         => _dbTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],

	],
];
