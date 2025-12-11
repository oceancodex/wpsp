<?php

namespace WPSP\App\WordPress\NavigationMenus\Locations;

use WPSP\App\Extends\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\NavigationMenus\Locations\BaseNavigationLocation;

class nav_primary extends BaseNavigationLocation {

	use InstancesTrait;

	// Args.
//	public $location    = '';
	public $description = 'Navigation primary';

	/*
	 *
	 */

	public function customProperties() {
//		$this->location    = 'nav_primary';
//		$this->description = 'Primary navigation menu';
	}

}