<?php
namespace WPSP\routes;

use WPSP\App\Widen\Routes\DashboardWidgets\DashboardWidgets as Route;
use WPSP\App\WordPress\DashboardWidgets\dashboard_widget_demo;
use WPSP\App\WordPress\DashboardWidgets\dashboard_widget_demo_view;
use WPSPCORE\App\Routes\DashboardWidgets\DashboardWidgetsRouteTrait;

class DashboardWidgets {

	use DashboardWidgetsRouteTrait;

	/*
	 *
	 */

	public function dashboard_widgets() {
		Route::widget('dashboard_widget_demo', [dashboard_widget_demo::class, 'index'], ['priority' => 30]);
		Route::widget('dashboard_widget_demo_view', [dashboard_widget_demo_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {
		add_action('wp_dashboard_setup', function() {
			// Remove Welcome panel.
			remove_action('welcome_panel', 'wp_welcome_panel');

			// Remove all Dashboard widgets.
			global $wp_meta_boxes;
			unset($wp_meta_boxes['dashboard']);
		}, 20);
	}

	public function filters() {}

}