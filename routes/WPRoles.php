<?php

namespace WPSP\routes;

use WPSP\App\Components\WPRoles\super_admin;
use WPSPCORE\Routes\BaseRoute;
use WPSP\App\Instances\Routes\WPRoles as Route;
use WPSPCORE\Routes\WPRoles\WPRolesRouteTrait;

class WPRoles extends BaseRoute {

	use WPRolesRouteTrait;

	public function roles() {
		Route::role('super_admin', [super_admin::class])->name('xxx');
	}

	public function actions() {}

	public function filters() {}

}