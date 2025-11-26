<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\Filters\FiltersRouteTrait;

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