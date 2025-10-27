<?php
use WPSP\Funcs;

if (!defined('DB_NAME')) {
	$wpConfig = Funcs::instance()->_getWPConfig();
}

return [
	'dbname'   => defined('DB_NAME') ? DB_NAME : ($wpConfig['DB_NAME'] ?? Funcs::env('DB_DATABASE', true)),
	'user'     => defined('DB_USER') ? DB_USER : ($wpConfig['DB_USER'] ?? Funcs::env('DB_USERNAME', true)),
	'password' => defined('DB_PASSWORD') ? DB_PASSWORD : ($wpConfig['DB_PASSWORD'] ?? Funcs::env('DB_PASSWORD', true)),
	'host'     => defined('DB_HOST') ? DB_HOST : ($wpConfig['DB_HOST'] ?? Funcs::env('DB_HOST', true, '127.0.0.1')),
	'port'     => defined('DB_PORT') ? DB_PORT : ($wpConfig['DB_PORT'] ?? Funcs::env('DB_PORT', true, '3306')),
	'driver'   => 'pdo_mysql',
	'memory'   => true,
];