<?php
/**
 * Plugin Name:         WPSP Framework - WordPress Starter Plugin
 * Description:         WPSP Framework - WordPress Starter Plugin - PHP ^8.2
 * Version:             12.1.31
 * Requires at least:   6.1
 * Requires PHP:        8.2
 * Text Domain:         wpsp
 * Domain Path:         /lang
 * Author:              OceanCodex
 * Plugin URI:          https://oceancodex.com
 * Author URI:          https://oceancodex.com
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!defined('WPSP_ARTISAN_START') && !defined('WPSP_ORIGINAL_WP')) {
	require_once __DIR__ . '/bootstrap/plugin.php';
}