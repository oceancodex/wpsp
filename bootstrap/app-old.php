<?php

use WPSP\app\Workers\Auth\Auth;
use WPSP\app\Workers\Cache\Cache;
use WPSP\app\Workers\Cache\RateLimiter;
use WPSP\app\Workers\Container\Container;
use WPSP\app\Workers\Database\Eloquent;
use WPSP\app\Workers\Database\Migration;
use WPSP\app\Workers\Environment\Environment;
use WPSP\app\Workers\ErrorHandler\ErrorHandler;
use WPSP\app\Workers\Events\Events;
use WPSP\app\Workers\Log\Log;
use WPSP\app\Workers\Queue\Queue;
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

/**
 * ---
 * Khởi động vài dịch vụ sớm.
 * ---
 */
add_action('plugins_loaded', function() {
	Environment::init(__DIR__ . '/../');
	Funcs::init();
	ErrorHandler::init();
}, 1);

/**
 * ---
 * Khởi động các dịch vụ cốt lõi.
 * ---
 */
add_action('init', function() {
	include_once __DIR__ . '/fake-classes.php';

	Container::init();

	/**
	 * Services.
	 */
	Log::init();
	Auth::init();
	Eloquent::init();
	Blade::init();
	Migration::init();
	Events::init();
	Validation::init();
	Cache::init();
	RateLimiter::init();
	Queue::init();
	Translation::init();
	WPTranslation::init();
	Updater::init();

	/**
	 * Routers.
	 */
	// Prepare routes mapping.
	$Apis              = new Apis();
	$Ajaxs             = new Ajaxs();
	$AdminPages        = new AdminPages();
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