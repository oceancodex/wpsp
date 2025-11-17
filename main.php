<?php
/**
 * Plugin Name:         WordPress Starter Plugin
 * Description:         WordPress Starter Plugin - PHP 8.4
 * Version:             1.0.0
 * Requires at least:   6.7
 * Requires PHP:        8.4
 * Text Domain:         wpsp
 * Domain Path:         /resources/lang
 * Author:              OceanCodex
 * Plugin URI:          https://oceancodex.com
 * Author URI:          https://oceancodex.com
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
	exit;
}

add_action('cli_init', function () {
	if ( defined('WP_CLI') && WP_CLI ) {
		\WP_CLI::add_command('wpsp route-remap', 'WPSPCORE\Console\Commands\RouteRemapCommand');
	}
});


require_once __DIR__ . '/bootstrap/app.php';