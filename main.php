<?php
/**
 * Plugin Name:         WordPress Starter Plugin
 * Description:         WordPress Starter Plugin - PHP 8.3
 * Version:             1.0.0
 * Requires at least:   6.4
 * Requires PHP:        8.3
 * Text Domain:         wpsp
 * Domain Path:         resources/lang
 * Author:              OceanCodex
 * Plugin URI:          https://oceancodex.com
 * Author URI:          https://oceancodex.com
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 */

// Application.
if (!defined('ABSPATH')) exit;
if (!defined('STDIN')) define('STDIN', fopen('php://stdin', 'r'));
if (!defined('IS_CONSOLE')) require_once 'bootstrap/app.php';