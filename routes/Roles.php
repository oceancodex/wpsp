<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\RolesRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\Roles\super_admin;

class Roles extends BaseRouter {

	use InstancesTrait, RolesRouteTrait;

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