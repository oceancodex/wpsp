<?php
/**
 * Plugin Name:         OceanCodex Base Plugin
 * Description:         OceanCodex Base Plugin - PHP 8.2
 * Version:             1.0.2
 * Requires at least:   6.1
 * Requires PHP:        8.2
 * Text Domain:         wpsp
 * Domain Path:         core/resources/lang
 * Author:              OceanCodex
 * Plugin URI:          https://oceancodex.com
 * Author URI:          https://oceancodex.com
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) exit;
if (!defined('WPSP_PATH')) define('WPSP_PATH', untrailingslashit(plugin_dir_path(__FILE__)));
require_once 'bootstrap/app.php';