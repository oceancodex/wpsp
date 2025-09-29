<?php

namespace wpsp\routes;

use WPSPCORE\Base\BaseRoute;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Traits\RolesRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extras\Components\Roles\super_admin;

class Roles extends BaseRoute {

	use RolesRouteTrait, InstancesTrait;

	public function roles(): void {
		$this->role('super_admin', [super_admin::class, null], true, null, [
//			'relation' => 'OR',
//			[AdministratorCapability::class, 'handle'],
//			[FrontendMiddleware::class, 'handle'],
		]);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}