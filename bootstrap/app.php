<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
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
use WPSP\routes\Roles;
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
add_action('init', function () {
//  Prepare routes mapping.
	$Apis              = new Apis();
//	$Ajaxs             = new Ajaxs();
//	$AdminPages        = new AdminPages();
//	$RewriteFrontPages = new RewriteFrontPages();

//  Init routes mapping.
//	$Apis->initRouterMap();
//	$Ajaxs->initRouterMap();
//	$AdminPages->initRouterMap();
//	$RewriteFrontPages->initRouterMap();

//  Init routes without mapping.
//	(new Roles())->init();
	$Apis->init();
//	$Ajaxs->init();
//	(new Schedules())->init();
//	(new PostTypes())->init();
//	(new PostTypeColumns())->init();
//	(new MetaBoxes())->init();
//	(new Templates())->init();
//	(new Taxonomies())->init();
//	(new TaxonomyColumns())->init();
//	(new Shortcodes())->init();
//	$AdminPages->init();

//	(new NavLocations())->init();
//	(new UserMetaBoxes())->init();
//	$RewriteFrontPages->init();
//	(new Actions())->init();
//	(new Filters())->init();

	RouteManager::instance()->executeAllRoutes();

	if (in_array(Funcs::env('APP_ENV', true), ['local', 'dev'])) {
		RouteMap::instance()->build();
	}

});