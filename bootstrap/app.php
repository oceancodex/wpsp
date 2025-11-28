<?php

use WPSP\App\Instances\Routes\RouteManager;
use WPSP\App\Instances\Routes\RouteMap;
use WPSP\WPSP;
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
use WPSP\routes\WPRoles;
use WPSP\routes\Schedules;
use WPSP\routes\Shortcodes;
use WPSP\routes\Taxonomies;
use WPSP\routes\TaxonomyColumns;
use WPSP\routes\Templates;
use WPSP\routes\UserMetaBoxes;

require_once __DIR__ . '/../vendor/autoload.php';

add_action('plugins_loaded', function() {
	WPSP::init();
}, 1);

// Bootstrap routes.
add_action('plugins_loaded', function () {
	$routes = [
		WPRoles::class,
		Apis::class,
//		Ajaxs::class,
//		Schedules::class,
//		PostTypes::class,
//		PostTypeColumns::class,
//		MetaBoxes::class,
//		Templates::class,
//		Taxonomies::class,
//		TaxonomyColumns::class,
//		Shortcodes::class,
		AdminPages::class,
//		NavLocations::class,
//		UserMetaBoxes::class,
//		RewriteFrontPages::class,
//		Actions::class,
//		Filters::class
	];

	foreach ($routes as $route) {
		(new $route())->init();
	}

	RouteManager::instance()->executeAllRoutes();

	if (in_array(Funcs::env('APP_ENV', true), ['local', 'dev'])) {
		RouteMap::instance()->build();
	}
});