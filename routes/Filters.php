<?php

namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\FiltersRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;

class Filters extends BaseRoute {

	use InstancesTrait, FiltersRouteTrait;

	/*
	 *
	 */

	public function filters() {}

}