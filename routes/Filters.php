<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Traits\FiltersRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;

class Filters extends BaseRoute {

	use FiltersRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function filters(): void {}

}