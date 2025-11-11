<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\NavLocationsRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\NavigationMenus\Locations\nav_primary;

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