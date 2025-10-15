<?php

use WPSP\app\Extras\Instances\Cache\Cache;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Extras\Instances\Database\Eloquent;
use WPSP\app\Extras\Instances\Database\Migration;
use WPSP\app\Extras\Instances\ErrorHandler\ErrorHandler;
use WPSP\app\Extras\Instances\Events\Event;
use WPSP\app\Extras\Instances\Translator\Translator;
use WPSP\app\Extras\Instances\Updater\Updater;
use WPSP\routes\Actions;
use WPSP\routes\AdminPages;
use WPSP\routes\Ajaxs;
use WPSP\routes\Apis;
use WPSP\routes\Filters;
use WPSP\routes\MetaBoxes;
use WPSP\routes\NavLocations;
use WPSP\routes\PostTypes;
use WPSP\routes\RewriteFrontPages;
use WPSP\routes\Roles;
use WPSP\routes\Schedules;
use WPSP\routes\Shortcodes;
use WPSP\routes\Taxonomies;
use WPSP\routes\Templates;
use WPSPCORE\Environment\Environment;

if (PHP_VERSION_ID < 70400 || PHP_VERSION_ID >= 80000) {
	add_action('admin_notices', function() {
		wp_admin_notice('"WPSP" requires PHP version from 7.4.0 to below 8.0.0. Please check your PHP version!', ['type' => 'error', 'dismissible' => true]);
	});
	return;
}

require_once __DIR__ . '/../vendor/autoload.php';

add_action('plugins_loaded', function() {

	/**
	 * Environment.
	 */
	Environment::load(__DIR__ . '/../');

	/**
	 * Error handler.
	 */
	if (class_exists('\WPSPCORE\ErrorHandler\Debug') || class_exists('\WPSPCORE\ErrorHandler\Ignition')) {
		if (!headers_sent()) {
			ErrorHandler::init();
		}
	}

}, 1);

add_action('init', function() {

	/**
	 * Auth.
	 */
	if (class_exists('\WPSPCORE\Auth\Auth')) {
		if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
			session_start();
		}
	}

	/**
	 * Fake classes.
	 */
	include_once __DIR__ . '/fake-classes.php';

	/**
	 * Events.
	 */
	if (class_exists('\WPSPCORE\Events\Event\Dispatcher')) {
		Event::init();
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
	(new Roles())->init();
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

}, 1);