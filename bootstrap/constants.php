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
if (defined('OCBP_PATH')) {
	define('OCBP_PLUGIN_FILE_PATH', OCBP_PATH . '/main.php');
	define('OCBP_PLUGIN_DATA', get_plugin_data(OCBP_PLUGIN_FILE_PATH));
	define('OCBP_APP_PATH', OCBP_PATH . '/app');
	define('OCBP_CONTROLLER_PATH', OCBP_APP_PATH . '/Http/Controllers');
	define('OCBP_CONFIG_PATH', OCBP_PATH . '/config');
	define('OCBP_ROUTES_PATH', OCBP_PATH . '/routes');
	define('OCBP_RESOURCES_PATH', OCBP_PATH . '/resources');
	define('OCBP_STORAGE_PATH', OCBP_PATH . '/storage');
	define('OCBP_DATABASE_PATH', OCBP_PATH . '/database');
	define('OCBP_MIGRATION_PATH', OCBP_DATABASE_PATH . '/migrations');
	define('OCBP_URL', untrailingslashit(plugin_dir_url(OCBP_PLUGIN_FILE_PATH)));
	define('OCBP_PUBLIC_PATH', OCBP_PATH . '/public');
	define('OCBP_PUBLIC_URL', OCBP_URL . '/public');
	define('OCBP_VERSION', OCBP_PLUGIN_DATA['Version']);
	define('OCBP_TEXT_DOMAIN', OCBP_PLUGIN_DATA['TextDomain']);
	define('OCBP_REQUIRES_PHP', OCBP_PLUGIN_DATA['RequiresPHP']);
}