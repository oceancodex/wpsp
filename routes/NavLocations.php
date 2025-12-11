<?php

namespace WPSP\routes;

use WPSP\App\Extends\Routes\NavigationMenus\Locations\Locations as Route;
use WPSP\App\WordPress\NavigationMenus\Locations\nav_primary;
use WPSPCORE\App\Routes\NavigationMenus\Locations\NavLocationsRouteTrait;

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