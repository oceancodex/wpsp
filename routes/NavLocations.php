<?php

namespace WPSP\routes;

use WPSP\App\WP\NavigationMenus\Locations\nav_primary;
use WPSP\App\Instances\Routes\NavigationMenus\Locations\Locations as Route;
use WPSPCORE\Routes\NavigationMenus\Locations\NavLocationsRouteTrait;

class NavLocations {

	use NavLocationsRouteTrait;

	public function nav_locations() {
		Route::nav_location('nav_primary', [nav_primary::class]);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}