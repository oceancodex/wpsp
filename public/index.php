<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

/**
 * ---
 * Run WPRP Original with full load WordPress.
 */
define('WPSP_ORIGINAL_WP', false);

/**
 * ---
 * Start WPSP Original.
 */
define('WPSP_ORIGINAL_START', microtime(true));

/**
 * ---
 * Determine if the application is in maintenance mode...
 */
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/**
 * ---
 * Load full WordPress if you need.
 */
if (defined('WPSP_ORIGINAL_WP') && WPSP_ORIGINAL_WP) {
	require_once __DIR__.'/../../../../wp-load.php';
}

/**
 * ---
 * Register the Composer autoloader...
 */
require __DIR__.'/../vendor/autoload.php';

/**
 * ---
 * Bootstrap WPSP and handle the request...
 */
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->handleRequest(Request::capture());
