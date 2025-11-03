<?php

use WPSP\app\Workers\Cache\Cache;
use WPSP\app\Workers\Cache\RateLimiter;
use WPSP\app\Workers\Container\Container;
use WPSP\app\Workers\Database\Eloquent;
use WPSP\app\Workers\Database\Migration;
use WPSP\app\Workers\Environment\Environment;
use WPSP\app\Workers\ErrorHandler\ErrorHandler;
use WPSP\app\Workers\Events\Event;
use WPSP\app\Workers\Translator\Translator;
use WPSP\app\Workers\Updater\Updater;
use WPSP\app\Workers\Validation\Validation;
use WPSP\app\Workers\View\Blade;
use WPSP\Funcs;
use WPSP\routes\Actions;
use WPSP\routes\AdminPages;
use WPSP\routes\Ajaxs;
use WPSP\routes\Apis;
use WPSP\routes\Filters;
use WPSP\routes\MetaBoxes;
use WPSP\routes\NavLocations;
use WPSP\routes\PostTypeColumns;
use WPSP\routes\PostTypes;
use WPSP\routes\RewriteFrontPages;
use WPSP\routes\Roles;
use WPSP\routes\Schedules;
use WPSP\routes\Shortcodes;
use WPSP\routes\Taxonomies;
use WPSP\routes\TaxonomyColumns;
use WPSP\routes\Templates;
use WPSP\routes\UserMetaBoxes;

if (PHP_VERSION_ID < 80400 || PHP_VERSION_ID >= 80500) {
	add_action('admin_notices', function() {
		wp_admin_notice('"WPSP" requires PHP version from 8.4.0 to below 8.5.0. Please check your PHP version!', ['type' => 'error', 'dismissible' => true]);
	});
	return;
}

require_once __DIR__ . '/../vendor/autoload.php';

add_action('plugins_loaded', function() {
	/**
	 * Environment.
	 */
	Environment::init(__DIR__ . '/../');

	/**
	 * Funcs.
	 */
	Funcs::init();

	/**
	 * Error handler.
	 */
	if (class_exists('\WPSPCORE\ErrorHandler\Debug') || class_exists('\WPSPCORE\ErrorHandler\Ignition')) {
		if (!headers_sent()) {
			ErrorHandler::init();

			// Lấy Ignition's exception handler
			$ignitionHandler = set_exception_handler(null);

			// Đăng ký custom handler với Ignition handler
			set_exception_handler(function(\Throwable $e) use ($ignitionHandler) {
				$handler = new \WPSP\app\Workers\Exceptions\Handler(
					Funcs::instance()->_getMainPath(),
					Funcs::instance()->_getRootNamespace(),
					Funcs::instance()->_getPrefixEnv(),
					[
						'funcs'            => Funcs::instance(),
						'ignition_handler' => $ignitionHandler,
					]
				);
				$handler->report($e);
				$handler->render($e);
			});
		}
	}
}, 1);

add_action('init', function() {
	/**
	 * Fake classes.
	 */
	include_once __DIR__ . '/fake-classes.php';

	/**
	 * Auth.
	 */
	if (class_exists('\WPSPCORE\Auth\Auth')) {
		if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
			session_start();
		}
	}

	/**
	 * Eloquent.
	 */
	if (class_exists('\WPSPCORE\Database\Eloquent')) {
		Eloquent::init();

		// Set event dispatcher for Eloquent models.
		$container = Container::instance();
		if ($container) {
			Illuminate\Database\Eloquent\Model::setEventDispatcher(new \Illuminate\Events\Dispatcher($container));
		}
	}

	/**
	 * Blade.
	 */
	if (class_exists('WPSPCORE\View\Blade')) {
		Blade::init();
	}

	/**
	 * Migration.
	 */
	if (class_exists('\WPSPCORE\Migration\Migration')) {
		Migration::init();
	}

	/**
	 * Events.
	 */
	if (class_exists('\WPSPCORE\Events\Event\Dispatcher')) {
		Event::init();
	}

	/**
	 * Validation - Init after Eloquent
	 */
	if (class_exists('\WPSPCORE\Validation\Validation')) {
		Validation::init();
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
	// Prepare routes mapping.
	$Apis = new Apis();
	$Ajaxs = new Ajaxs();
	$AdminPages = new AdminPages();
	$RewriteFrontPages = new RewriteFrontPages();

	// Init routes mapping.
	$Apis->initRouterMap();
	$Ajaxs->initRouterMap();
	$AdminPages->initRouterMap();
	$RewriteFrontPages->initRouterMap();

	// Init routes without mapping.
	(new Roles())->init();
	$Apis->init();
	$Ajaxs->init();
	(new Schedules())->init();
	(new PostTypes())->init();
	(new PostTypeColumns())->init();
	(new MetaBoxes())->init();
	(new Templates())->init();
	(new Taxonomies())->init();
	(new TaxonomyColumns())->init();
	(new Shortcodes())->init();
	$AdminPages->init();
	(new NavLocations())->init();
	(new UserMetaBoxes())->init();
	$RewriteFrontPages->init();
	(new Actions())->init();
	(new Filters())->init();
}, 1);