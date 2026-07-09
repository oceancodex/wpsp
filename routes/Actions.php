<?php

namespace WPSP\routes;

use WPSP\App\Exceptions\ModelNotFoundException;
use WPSP\App\Http\Controllers\AssetsController;
use WPSP\App\Http\Controllers\PagesController;
use WPSP\App\Widen\Routes\Actions\Actions as Route;
use WPSP\App\Widen\Routes\RouteManager;
use WPSP\Funcs;
use WPSPCORE\App\Integrations\Debugbar\Collectors\WPSPRouteCollector;
use WPSPCORE\App\Routes\Actions\ActionsRouteTrait;

class Actions {

	use ActionsRouteTrait;

	/*
	 *
	 */

	public function actions() {
//		Route::action('wp_head', [PagesController::class, 'index']);
//		Route::action('save_post', [PagesController::class, 'save_post'], ['accepted_args' => 3]);
		Route::action('admin_enqueue_scripts', [AssetsController::class, 'backend']);
		Route::action('wp_enqueue_scripts', [AssetsController::class, 'frontend']);
//		Route::action('current_screen', [PagesController::class, 'edit_user_screen']);
	}

	/*
	 *
	 */

	public function wp_actions() {
		add_action('wpsp_model_not_found', function($className, $modelId, \Exception $exception) {
			$modelNotFoundException = new ModelNotFoundException($className, $exception->getMessage());
			$modelNotFoundException->render();
			exit;
		}, 10, 3);

		if (
			!Funcs::app()->runningInConsole()
			&& Funcs::env('WPSP_APP_DEBUG_MONITOR') === true
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
					try {
						$debugbar = Funcs::app('debugbar');
						if ($debugbar) {
							$wpspRouteCollector = Funcs::app()->make(WPSPRouteCollector::class, ['routeManagerInstance' => RouteManager::instance()]);
							$debugbar->addCollector($wpspRouteCollector);

//							$debugbar['messages']->addMessage('WP Admin');

							$debugbarJsHeader = $debugbar->getJavascriptRenderer()->renderHead();
							$debugbarJsFooter = $debugbar->getJavascriptRenderer()->render();

							echo $debugbarJsHeader;
							echo $debugbarJsFooter;
						}
					}
					catch (\Throwable $e) {
						error_log($e->getMessage());
					}
				}
			});
		}
	}

}