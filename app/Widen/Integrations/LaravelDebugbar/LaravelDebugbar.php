<?php
/**
 * Name: 			Laravel Debugbar
 * Description:		Integrate Laravel Debugbar.
 * Version:			1.0.0
 * Author:			OceanCodex
 * Requires WP:		6.4
 * Requires WPSP:	13.0
 * Requires PHP:	8.3
 */

namespace WPSP\App\Widen\Integrations\LaravelDebugbar;

use WPSP\App\Widen\Integrations\LaravelDebugbar\Collectors\WPSPRouteCollector;
use WPSP\App\Widen\Routes\RouteManager;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Integrations\BaseIntegration;

class LaravelDebugbar extends BaseIntegration {

	use InstancesTrait;

	public $activate = true;

	/*
	 *
	 */

	public function init() {
		if (
			!Funcs::app()->runningInConsole()
			&& Funcs::config('app.debug') === true
			&& Funcs::config('app.debug_monitor') === true
			&& class_exists('\Fruitcake\LaravelDebugbar\LaravelDebugbar')
		) {
			/** @var \Fruitcake\LaravelDebugbar\LaravelDebugbar $debugbar */
			add_action('shutdown', function() {
				if (
					!wp_doing_ajax()
					&& !wp_doing_cron()
					&& !wp_is_serving_rest_request()
					&& !defined('REST_REQUEST')
				) {
					$app = Funcs::app();
					$debugbar = $app->make('debugbar');
					if ($debugbar) {
						$wpspRouteCollector = $app->make(WPSPRouteCollector::class, ['routeManagerInstance' => RouteManager::instance()]);

						$debugbar->addCollector($wpspRouteCollector);

						$debugbarJsHeader = $debugbar->getJavascriptRenderer()->renderHead();
						$debugbarJsFooter = $debugbar->getJavascriptRenderer()->render();

						echo $debugbarJsHeader;
						echo $debugbarJsFooter;
					}
				}
			}, PHP_INT_MAX);
		}
	}

}