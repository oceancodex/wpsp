<?php

use WPSP\App\Widen\Routes\RouteManager;
use WPSP\App\Widen\Routes\RouteMap;
use WPSP\routes\Actions;
use WPSP\routes\AdminBarMenus;
use WPSP\routes\AdminPages;
use WPSP\routes\Ajaxs;
use WPSP\routes\Apis;
use WPSP\routes\Blocks;
use WPSP\routes\Filters;
use WPSP\routes\MetaBoxes;
use WPSP\routes\NavLocations;
use WPSP\routes\PostTypeColumns;
use WPSP\routes\PostTypes;
use WPSP\routes\RewriteFrontPages;
use WPSP\routes\FrontPages;
use WPSP\routes\Schedules;
use WPSP\routes\Shortcodes;
use WPSP\routes\Taxonomies;
use WPSP\routes\TaxonomyColumns;
use WPSP\routes\ThemeTemplates;
use WPSP\routes\UserMetaBoxes;
use WPSP\routes\WPRoles;
use WPSP\WPSP;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * ---
 * Start application.
 */
//add_action('plugins_loaded', function() {
	$wpsp = WPSP::start();
//}, 10);

/**
 * ---
 * Đăng ký và xử lý routes.
 */
//add_action('init', function() {
	foreach ([
		WPRoles::class,
		Shortcodes::class,
		Apis::class,
		Ajaxs::class,
		Schedules::class,
		PostTypes::class,
		PostTypeColumns::class,
		MetaBoxes::class,
		ThemeTemplates::class,
		Taxonomies::class,
		TaxonomyColumns::class,
		AdminPages::class,
		NavLocations::class,
		UserMetaBoxes::class,
		RewriteFrontPages::class,
		FrontPages::class,
		Blocks::class,
		AdminBarMenus::class,
		Actions::class,
		Filters::class,
	] as $route) {
		(new $route())->register();
	}
//}, 10);

/**
 * ---
 * Chạy tất cả các route đã đăng ký.
 */
add_action('init', function() {
	RouteManager::instance()->executeAllRoutes();
});