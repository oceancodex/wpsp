<?php

namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ActionsRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;

class Actions extends BaseRoute {

	use InstancesTrait, ActionsRouteTrait;

	/*
	 *
	 */

	public function actions() {}

}