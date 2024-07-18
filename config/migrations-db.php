<?php
use WPSP\Funcs;

if (!defined('DB_NAME')) {
	include Funcs::instance()->_getSitePath() . '/wp-config.php';
}

return [
	'dbname'   => (defined('DB_NAME')) ? DB_NAME : Funcs::env('DB_DATABASE', true),
	'user'     => (defined('DB_USER')) ? DB_USER : Funcs::env('DB_USERNAME', true),
	'password' => (defined('DB_PASSWORD')) ? DB_PASSWORD : Funcs::env('DB_PASSWORD', true),
	'host'     => (defined('DB_HOST')) ? DB_HOST : Funcs::env('DB_HOST', true, '127.0.0.1'),
	'driver'   => 'pdo_mysql',
	'memory'   => true,
];