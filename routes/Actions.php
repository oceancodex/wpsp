<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ActionsRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;

class Actions extends BaseRoute {

	use InstancesTrait, ActionsRouteTrait;

	/*
	 *
	 */

	public function actions() {}

}