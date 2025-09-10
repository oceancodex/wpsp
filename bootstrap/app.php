<?php
if (PHP_VERSION_ID < 80300) {
	add_action('admin_notices', function() {
		wp_admin_notice('"WPSP" requires PHP version from 8.3.0. Please check your PHP version!', ['type' => 'error', 'dismissible' => true]);
	});
	return;
}

require_once __DIR__ . '/../vendor/autoload.php';

use WPSP\routes\Apis;
use WPSP\routes\Ajaxs;
use WPSP\routes\Actions;
use WPSP\routes\Filters;
use WPSP\routes\Schedules;
use WPSP\routes\PostTypes;
use WPSP\routes\MetaBoxes;
use WPSP\routes\Taxonomies;
use WPSP\routes\Templates;
use WPSP\routes\Shortcodes;
use WPSP\routes\AdminPages;
use WPSP\routes\NavLocations;
use WPSP\routes\RewriteFrontPages;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\app\Extend\Instances\Updater\Updater;
use WPSP\app\Extend\Instances\Cache\RateLimiter;
use WPSP\app\Extend\Instances\Database\Eloquent;
use WPSP\app\Extend\Instances\Database\Migration;
use WPSP\app\Extend\Instances\Translator\Translator;
use WPSP\app\Extend\Instances\ErrorHandler\ErrorHandler;
use WPSPCORE\Environment\Environment;

add_action('init', function() {

	/**
	 * Environment.
	 */
	Environment::load(__DIR__ . '/../');

	/**
	 * Error handler.
	 */
	if (class_exists('\WPSPCORE\ErrorHandler\Debug') || class_exists('\WPSPCORE\ErrorHandler\Ignition')) {
		ErrorHandler::init();
	}

	/**
	 * Migration.
	 */
	if (class_exists('\WPSPCORE\Migration\Migration')) {
		Migration::init();
	}

	/**
	 * Eloquent.
	 */
	if (class_exists('\WPSPCORE\Database\Eloquent')) {
		Eloquent::init();
	}

	/**
	 * Cache.
	 */
	if (class_exists('\WPSPCORE\Cache\Cache')) {
		Cache::init();
	}

	/**
	 * Rate Limiter.
	 */
	if (class_exists('\WPSPCORE\Cache\Cache') && class_exists('\WPSPCORE\RateLimiter\RateLimiter')) {
		RateLimiter::init();
	}

	/**
	 * Translation.
	 */
	Translator::init();

	/**
	 * Updater.
	 */
	Updater::init();

	/**
	 * Routers.
	 */
	(new Apis())->init();
	(new Ajaxs())->init();
	(new Schedules())->init();
	(new PostTypes())->init();
	(new MetaBoxes())->init();
	(new Templates())->init();
	(new Taxonomies())->init();
	(new Shortcodes())->init();
	(new AdminPages())->init();
	(new NavLocations())->init();
	(new RewriteFrontPages())->init();
	(new Actions())->init();
	(new Filters())->init();

});