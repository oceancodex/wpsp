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
		Route::widget('dashboard_widget_demo', [dashboard_widget_demo::class, 'index']);
		Route::widget('dashboard_widget_demo_view', [dashboard_widget_demo_view::class, 'index']);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}