<?php

namespace WPSP\routes;

use WPSP\App\Widen\Routes\WPRoles\WPRoles as Route;
use WPSP\App\WordPress\WPRoles\super_admin;
use WPSPCORE\App\Routes\WPRoles\WPRolesRouteTrait;

class WPRoles {

	use WPRolesRouteTrait;

	public function wp_roles() {
		Route::wp_role('super_admin', [super_admin::class])->name('super_admin');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}