<?php

namespace WPSP\routes;

use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\NavLocationsRouteTrait;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\AdministratorCapability;
use WPSP\app\Extends\Components\NavigationMenus\Locations\nav_primary;

class NavLocations extends BaseRoute {

	use NavLocationsRouteTrait, InstancesTrait;

	public function nav_locations(): void {
		$this->nav_location('nav_primary', [nav_primary::class, null], true);
	}

	/*
	 *
	 */

	public function actions(): void {}

	public function filters(): void {}

}