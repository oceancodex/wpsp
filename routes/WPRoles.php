<?php

namespace WPSP\routes;

use WPSP\App\WP\WPRoles\super_admin;
use WPSP\App\Instances\Routes\WPRoles as Route;
use WPSPCORE\Routes\WPRoles\WPRolesRouteTrait;

class WPRoles {

	use WPRolesRouteTrait;

	public function roles() {
		Route::role('super_admin', [super_admin::class]);
	}

	public function actions() {}

	public function filters() {}

}