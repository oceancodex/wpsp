<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
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

//$app = Application::configure(basePath: dirname(__DIR__))
//	->withRouting(
//		web: __DIR__.'/../routes/web.php',
//		commands: __DIR__.'/../routes/console.php',
//		health: '/up',
//	)
//	->withMiddleware(function (Middleware $middleware): void {
//		$middleware->append(\Illuminate\Session\Middleware\StartSession::class);
//	})
//	->withExceptions(function (Exceptions $exceptions): void {
//		//
//	})->create();

WPSP::init();

//$app = WPSP::instance()->getApplication();

//add_action('parse_request', function(\WP $wp) use ($app) {
//	$request  = Request::capture();
//	$kernel   = $app->make(\Illuminate\Contracts\Http\Kernel::class);
//	$response = $kernel->handle($request);
//	$response->send();
//	$kernel->terminate($request, $response);
//	exit;
//}, 0);

// Bootstrap routes.
add_action('init', function () {
//  Prepare routes mapping.
	$Apis              = new Apis();
//	$Ajaxs             = new Ajaxs();
	$AdminPages        = new AdminPages();
//	$RewriteFrontPages = new RewriteFrontPages();

//  Init routes mapping.
	$Apis->initRouterMap();
//	$Ajaxs->initRouterMap();
	$AdminPages->initRouterMap();
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
	$AdminPages->init();

//	(new NavLocations())->init();
//	(new UserMetaBoxes())->init();
//	$RewriteFrontPages->init();
//	(new Actions())->init();
//	(new Filters())->init();
});