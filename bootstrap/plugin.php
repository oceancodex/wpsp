<?php

use WPSP\App\Widen\Integrations\Integration;
use WPSP\App\Widen\Routes\RouteManager;
use WPSP\App\Widen\Routes\RouteMap;
use WPSP\WPSP;
use WPSP\Routes\Actions;
use WPSP\Routes\AdminBarMenus;
use WPSP\Routes\AdminPages;
use WPSP\Routes\Ajaxs;
use WPSP\Routes\Apis;
use WPSP\Routes\Blocks;
use WPSP\Routes\CommentColumns;
use WPSP\Routes\Customizers;
use WPSP\Routes\DashboardWidgets;
use WPSP\Routes\Filters;
use WPSP\Routes\FrontPages;
use WPSP\Routes\MediaColumns;
use WPSP\Routes\MetaBoxes;
use WPSP\Routes\NavLocations;
use WPSP\Routes\PluginColumns;
use WPSP\Routes\PostTypeColumns;
use WPSP\Routes\PostTypes;
use WPSP\Routes\RewriteFrontPages;
use WPSP\Routes\Schedules;
use WPSP\Routes\Shortcodes;
use WPSP\Routes\Taxonomies;
use WPSP\Routes\TaxonomyColumns;
use WPSP\Routes\ThemeTemplates;
use WPSP\Routes\UserColumns;
use WPSP\Routes\UserMetaBoxes;
use WPSP\Routes\Widgets;
use WPSP\Routes\WPRoles;

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