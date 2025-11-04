<?php

use WPSP\app\Workers\Cache\Cache;
use WPSP\app\Workers\Cache\RateLimiter;
use WPSP\app\Workers\Container\Container;
use WPSP\app\Workers\Database\Eloquent;
use WPSP\app\Workers\Database\Migration;
use WPSP\app\Workers\Environment\Environment;
use WPSP\app\Workers\ErrorHandler\ErrorHandler;
use WPSP\app\Workers\Events\Event;
use WPSP\app\Workers\Translation\Translation;
use WPSP\app\Workers\Translation\WPTranslation;
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
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-error-handler')) {
		if (!headers_sent()) {
			ErrorHandler::init();

			// Lấy Ignition's exception handler
			$ignitionHandler = set_exception_handler(null);

			// Đăng ký custom handler với Ignition handler
			if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-validation')) {
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
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-auth')) {
		if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
			session_start();
		}
	}

	/**
	 * Eloquent.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-database')) {
		Eloquent::init();

		// Set event dispatcher for Eloquent models.
		$container = Container::instance();
		if ($container) {
			$useMongoDB = is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-mongodb');
			Container::bootEvent($container, $useMongoDB);
		}
	}

	/**
	 * Blade.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-view')) {
		Blade::init();
	}

	/**
	 * Migration.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-migration')) {
		Migration::init();
	}

	/**
	 * Events.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-events')) {
		Event::init();
	}

	/**
	 * Validation - Init after Eloquent
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-validation')) {
		Validation::init();
	}

	/**
	 * Cache.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-cache')) {
		Cache::init();
	}

	/**
	 * Rate Limiter.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-rate-limiter')) {
		RateLimiter::init();
	}

	/**
	 * Translation.
	 */
	if (is_dir(__DIR__ . '/../vendor/oceancodex/wpsp-translation')) {
		Translation::init();
	}

	/**
	 * WP Translation.
	 */
	WPTranslation::init();

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