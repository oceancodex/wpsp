<?php

use WPSP\app\Extras\Instances\Cache\Cache;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\app\Extras\Instances\Container\Container;
use WPSP\app\Extras\Instances\Database\Eloquent;
use WPSP\app\Extras\Instances\Database\Migration;
use WPSP\app\Extras\Instances\ErrorHandler\ErrorHandler;
use WPSP\app\Extras\Instances\Events\Event;
use WPSP\app\Extras\Instances\Translator\Translator;
use WPSP\app\Extras\Instances\Updater\Updater;
use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\Funcs;
use WPSP\routes\Actions;
use WPSP\routes\AdminPages;
use WPSP\routes\Ajaxs;
use WPSP\routes\Apis;
use WPSP\routes\Filters;
use WPSP\routes\MapRoutes;
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
use WPSPCORE\Environment\Environment;

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
				$handler = new \WPSP\app\Extras\Instances\Exceptions\Handler(
					Funcs::instance()->_getMainPath(),
					Funcs::instance()->_getRootNamespace(),
					Funcs::instance()->_getPrefixEnv(),
					[
						'ignition_handler' => $ignitionHandler
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
	 * Container.
	 */
	$container = Container::instance();

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
		if ($container) Illuminate\Database\Eloquent\Model::setEventDispatcher(new \Illuminate\Events\Dispatcher($container));
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



	(new Apis())->withRouterMap();
	(new Ajaxs())->withRouterMap();
	(new AdminPages())->withRouterMap();

//	(new Roles())->init();
	(new Apis())->init();
//	(new Ajaxs())->init();
//	(new Schedules())->init();
//	(new PostTypes())->init();
//	(new PostTypeColumns())->init();
//	(new MetaBoxes())->init();
//	(new Templates())->init();
//	(new Taxonomies())->init();
//	(new TaxonomyColumns())->init();
//	(new Shortcodes())->init();
	(new AdminPages())->init();
//	(new NavLocations())->init();
//	(new UserMetaBoxes())->init();
//	(new RewriteFrontPages())->init();
//	(new Actions())->init();
//	(new Filters())->init();

	$mapRoutes = MapRoutes::instance();
	if (is_admin()) {
		echo '<pre style="background:white;z-index:9999;position:relative">'; print_r($mapRoutes->map); echo '</pre>';
	}
}, 1);