<?php
if (!defined('DB_NAME')) {
	include WPSP\Funcs::instance()->getSitePath() . '/wp-config.php';
}
return [
	'dbname'   => (defined('DB_NAME') && DB_NAME) ? DB_NAME : env('DB_DATABASE'),
	'user'     => (defined('DB_USER') && DB_USER) ? DB_USER : env('DB_USERNAME'),
	'password' => (defined('DB_PASSWORD') && DB_PASSWORD) ? DB_PASSWORD : env('DB_PASSWORD'),
	'host'     => (defined('DB_HOST') && DB_HOST) ? DB_HOST : env('DB_HOST', '127.0.0.1'),
	'driver'   => 'pdo_mysql',
	'memory'   => true,
];