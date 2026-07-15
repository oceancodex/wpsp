<?php

use WPSP\App\Widen\Integrations\Integration;
use WPSP\App\Widen\Routes\RouteManager;
use WPSP\App\Widen\Routes\RouteMap;
use WPSP\WPSP;
use WPSP\routes\Actions;
use WPSP\routes\AdminBarMenus;
use WPSP\routes\AdminPages;
use WPSP\routes\Ajaxs;
use WPSP\routes\Apis;
use WPSP\routes\Blocks;
use WPSP\routes\CommentColumns;
use WPSP\routes\Customizers;
use WPSP\routes\DashboardWidgets;
use WPSP\routes\Filters;
use WPSP\routes\FrontPages;
use WPSP\routes\MediaColumns;
use WPSP\routes\MetaBoxes;
use WPSP\routes\NavLocations;
use WPSP\routes\PluginColumns;
use WPSP\routes\PostTypeColumns;
use WPSP\routes\PostTypes;
use WPSP\routes\RewriteFrontPages;
use WPSP\routes\Schedules;
use WPSP\routes\Shortcodes;
use WPSP\routes\Taxonomies;
use WPSP\routes\TaxonomyColumns;
use WPSP\routes\ThemeTemplates;
use WPSP\routes\UserColumns;
use WPSP\routes\UserMetaBoxes;
use WPSP\routes\Widgets;
use WPSP\routes\WPRoles;

require_once __DIR__ . '/../vendor/autoload.php';

define('WPSP_PLUGIN_START', microtime(true));

/**
 * ---
 * Start application.
 */
//add_action('init', function() {
	$wpsp = WPSP::start();
//}, 10);

/**
 * Tích hợp.
 */
Integration::instance()->register();

/**
 * ---
 * Đăng ký và xử lý routes.
 */
//add_action('init', function() {
	foreach ([
		Actions::class,
		AdminBarMenus::class,
		AdminPages::class,
		Ajaxs::class,
		Apis::class,
		Blocks::class,
		CommentColumns::class,
		Customizers::class,
		DashboardWidgets::class,
		Filters::class,
		FrontPages::class,
		MediaColumns::class,
		MetaBoxes::class,
		NavLocations::class,
		PluginColumns::class,
		PostTypeColumns::class,
		PostTypes::class,
		RewriteFrontPages::class,
		Schedules::class,
		Shortcodes::class,
		Taxonomies::class,
		TaxonomyColumns::class,
		ThemeTemplates::class,
		UserColumns::class,
		UserMetaBoxes::class,
		Widgets::class,
		WPRoles::class,
	] as $route) {
		(new $route())->register();
	}
//}, 10);

//dd(RouteMap::instance()->getMap());

/**
 * ---
 * Chạy tất cả các route đã đăng ký.
 */
add_action('init', function() {
	RouteManager::instance()->executeAllRoutes(['Widgets']);
});

/**
 * Chạy các route với types của chúng được chỉ định.
 */
add_action('widgets_init', function() {
	RouteManager::instance()->executeRouteByTypes(['Widgets']);
});