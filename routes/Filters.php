<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\FiltersRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;

class Filters extends BaseRouter {

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