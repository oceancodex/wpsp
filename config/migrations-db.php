<?php
use WPSP\Funcs;

if (!defined('DB_NAME')) {
	include Funcs::instance()->getSitePath() . '/wp-config.php';
}

return [
	'dbname'   => (defined('DB_NAME') && DB_NAME) ? DB_NAME : Funcs::instance()->env('DB_DATABASE', true),
	'user'     => (defined('DB_USER') && DB_USER) ? DB_USER : Funcs::instance()->env('DB_USERNAME', true),
	'password' => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : Funcs::instance()->env('DB_PASSWORD', true),
	'host'     => (defined('DB_HOST') && DB_HOST) ? DB_HOST : Funcs::instance()->env('DB_HOST', true, '127.0.0.1'),
	'driver'   => 'pdo_mysql',
	'memory'   => true,
];