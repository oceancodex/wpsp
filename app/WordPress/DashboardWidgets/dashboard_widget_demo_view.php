<?php

namespace WPSP\App\WordPress\DashboardWidgets;

use Illuminate\Http\Request;
use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\WordPress\DashboardWidgets\BaseDashboardWidget;

class dashboard_widget_demo_view extends BaseDashboardWidget {

	use InstancesTrait;

	public $widget_id         = 'wpsp_dashboard_widget_demo_view';
	public $widget_name       = 'WPSP Dashboard Widget Demo View';
//	public $callback_args     = null;
	public $context           = 'column3'; // 'normal', 'side', 'column3', 'column4'
//	public $priority          = 'default'; // 'high', 'core', 'default', 'low'

	/*
	 *
	 */

//	public function __wpspConstruct(Request $request) {}

	/*
	 *
	 */

	/**
	 * Tùy chỉnh các tham số.
	 */
	public function customProperties(Request $request) {}

	/*
	 *
	 */

	public function index($post, $callback_args, Request $request) {
		echo Funcs::view('dashboard-widgets.dashboard_widget_demo_view')->render();
	}

	/*
	 *
	 */

	public function control_callback($post, $callback_args, Request $request) {
		echo '<p><input type="text" name="dashboard_widget_setting_1" style="width:100%;" placeholder="Setting 1..." autocomplete="off"/></p>';
	}

}