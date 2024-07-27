<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\HookRunnerTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;

class Actions extends BaseRoute {

	use HookRunnerTrait, InstancesTrait;

	/*
	 *
	 */

	public function actions(): void {}

}