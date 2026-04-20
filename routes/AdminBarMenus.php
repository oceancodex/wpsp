<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\AdminBarMenus\AdminBarMenus as Route;
use WPSP\App\WordPress\AdminBarMenus\wpsp;
use WPSP\App\WordPress\AdminBarMenus\wpsp_tab_dashboard;
use WPSPCORE\App\Routes\AdminBarMenus\AdminBarMenusRouteTrait;

class AdminBarMenus {

	use AdminBarMenusRouteTrait;

	public function admin_bar_menus() {
		Route::admin_bar_menu('wpsp', [wpsp::class]);
		Route::admin_bar_menu('wpsp_tab_dashboard', [wpsp_tab_dashboard::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}