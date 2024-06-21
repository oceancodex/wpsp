<?php
if (!function_exists('get_plugin_data')) {
	require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

if (!function_exists('wp_get_current_user')) {
	require_once(ABSPATH . 'wp-includes/pluggable.php');
}

if (!defined('STDIN')) {
	define('STDIN', fopen('php://stdin', 'r'));
}

// Defined some constants.
if (defined('WPSP_PATH')) {
	define('WPSP_PLUGIN_FILE_PATH', WPSP_PATH . '/main.php');
	define('WPSP_PLUGIN_DATA', get_plugin_data(WPSP_PLUGIN_FILE_PATH));
	define('WPSP_APP_PATH', WPSP_PATH . '/app');
	define('WPSP_CONTROLLER_PATH', WPSP_APP_PATH . '/Http/Controllers');
	define('WPSP_CONFIG_PATH', WPSP_PATH . '/config');
	define('WPSP_ROUTES_PATH', WPSP_PATH . '/routes');
	define('WPSP_RESOURCES_PATH', WPSP_PATH . '/resources');
	define('WPSP_STORAGE_PATH', WPSP_PATH . '/storage');
	define('WPSP_DATABASE_PATH', WPSP_PATH . '/database');
	define('WPSP_MIGRATION_PATH', WPSP_DATABASE_PATH . '/migrations');
	define('WPSP_URL', untrailingslashit(plugin_dir_url(WPSP_PLUGIN_FILE_PATH)));
	define('WPSP_PUBLIC_PATH', WPSP_PATH . '/public');
	define('WPSP_PUBLIC_URL', WPSP_URL . '/public');
	define('WPSP_VERSION', WPSP_PLUGIN_DATA['Version']);
	define('WPSP_TEXT_DOMAIN', WPSP_PLUGIN_DATA['TextDomain']);
	define('WPSP_REQUIRES_PHP', WPSP_PLUGIN_DATA['RequiresPHP']);
}