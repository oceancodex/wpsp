<?php

namespace WPSP\routes;

use WPSP\App\Instances\Routes\WPRoles\WPRoles as Route;
use WPSP\App\WP\WPRoles\super_admin;
use WPSPCORE\Routes\WPRoles\WPRolesRouteTrait;

class WPRoles {

	use WPRolesRouteTrait;

	public function roles() {
		Route::role('super_admin', [super_admin::class]);
	}

	public function actions() {}

	public function filters() {}

}