<?php

namespace WPSP\routes;

use WPSP\App\WP\NavigationMenus\Locations\nav_primary;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Routes\NavigationMenus\Locations\NavLocationsRouteTrait;

class NavLocations extends BaseRoute {

	use InstancesTrait, NavLocationsRouteTrait;

	public function nav_locations() {
		$this->nav_location('nav_primary', [nav_primary::class, null], true);
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}