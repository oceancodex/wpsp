<?php
use WPSP\Funcs;

return [
	'default'     => Funcs::instance()->env('DB_CONNECTION', true, 'mysql'),
	'connections' => [
		'mysql' => [
			'driver'         => 'mysql',
//			'url'            => Funcs::instance()->env('APP_DATABASE_URL', true),
			'host'           => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::instance()->env('DB_HOST', true, '127.0.0.1'),
			'port'           => Funcs::instance()->env('DB_PORT', true, '3306'),
			'database'       => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::instance()->env('DB_DATABASE', true),
			'username'       => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::instance()->env('DB_USERNAME', true),
			'password'       => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::instance()->env('DB_PASSWORD', true),
			'unix_socket'    => Funcs::instance()->env('APP_DB_SOCKET', true),
//          'charset'        => (defined('DB_CHARSET') && DB_CHARSET) ? DB_CHARSET : 'utf8',
//          'collation'      => (defined('DB_COLLATE') && DB_COLLATE) ? DB_COLLATE : 'utf8_unicode_ci',
			'prefix'         => Funcs::instance()->getDBTablePrefix(),
			'prefix_indexes' => true,
			'strict'         => true,
			'engine'         => null,
			'options'        => [],
		],

	],
];
