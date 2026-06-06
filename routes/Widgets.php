<?php
namespace WPSP\routes;

use WPSP\App\Widen\Routes\Widgets\Widgets as Route;
use WPSP\App\WordPress\Widgets\widget_demo;
use WPSP\App\WordPress\Widgets\widget_demo_view;
use WPSPCORE\App\Routes\Widgets\WidgetsRouteTrait;

class Widgets {

	use WidgetsRouteTrait;

	/*
	 *
	 */

	public function widgets() {
		Route::widget('widget_demo', [widget_demo::class]);
		Route::widget('widget_demo_view', [widget_demo_view::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}