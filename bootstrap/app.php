<?php

use WPSP\App\Widen\Routes\RouteManager;
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
use WPSP\routes\Schedules;
use WPSP\routes\Shortcodes;
use WPSP\routes\Taxonomies;
use WPSP\routes\TaxonomyColumns;
use WPSP\routes\Templates;
use WPSP\routes\UserMetaBoxes;
use WPSP\routes\WPRoles;
use WPSP\WPSP;

require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap routes.
add_action('wp_loaded', function() {
	/**
	 * ---
	 * Start application.
	 */
	WPSP::start();

	/**
	 * ---
	 * Đăng ký routes.
	 */
	foreach ([
		WPRoles::class,
		Shortcodes::class,
		Apis::class,
		Ajaxs::class,
		Schedules::class,
		PostTypes::class,
		PostTypeColumns::class,
		MetaBoxes::class,
		Templates::class,
		Taxonomies::class,
		TaxonomyColumns::class,
		AdminPages::class,
		NavLocations::class,
		UserMetaBoxes::class,
		RewriteFrontPages::class,
		Actions::class,
		Filters::class,
	] as $route) {
		(new $route())->register();
	}

	/**
	 * ---
	 * Chạy tất cả các route đã đăng ký.
	 */
	RouteManager::instance()->executeAllRoutes();
}, 1);