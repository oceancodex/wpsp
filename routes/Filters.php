<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\FiltersRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;

class Filters extends BaseRoute {

	use InstancesTrait, FiltersRouteTrait;

	/*
	 *
	 */

	public function filters() {}

	/*
	 *
	 */

	public function customProperties() {}

}