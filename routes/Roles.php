<?php

namespace WPSP\routes;

use WPSP\App\Components\Roles\super_admin;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\Roles\WPRolesRouteTrait;

class Roles extends BaseRoute {

	use InstancesTrait, WPRolesRouteTrait;

	public function roles() {
		$this->role('super_admin', [super_admin::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}