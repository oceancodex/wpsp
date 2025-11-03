<?php

namespace WPSP\routes;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\NavLocationsRouteTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Components\NavigationMenus\Locations\nav_primary;

class NavLocations extends BaseRoute {

	use InstancesTrait, NavLocationsRouteTrait;

	public function nav_locations() {
		$this->nav_location('nav_primary', [nav_primary::class, null], true);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}