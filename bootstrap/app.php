<?php
require_once __DIR__ . '/../vendor/autoload.php';

use WPSP\routes\Api;
use WPSP\routes\Ajax;
use WPSP\routes\Schedule;
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
	ErrorHandler::init();

	/**
	 * Migration.
	 */
	Migration::init();

	/**
	 * Eloquent.
	 */
	Eloquent::init();

	/**
	 * Cache.
	 */
	Cache::init();

	/**
	 * Rate Limiter.
	 */
	RateLimiter::init();

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
	(new Api())->init();
	(new Ajax())->init();
	(new Schedule())->init();
	(new PostTypes())->init();
	(new MetaBoxes())->init();
	(new Templates())->init();
	(new Taxonomies())->init();
	(new Shortcodes())->init();
	(new AdminPages())->init();
	(new NavLocations())->init();
	(new RewriteFrontPages())->init();
});