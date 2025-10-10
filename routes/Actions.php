<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ActionsRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;

class Actions extends BaseRoute {

	use ActionsRouteTrait;

	/*
	 *
	 */

	public function actions(): void {}

}