<?php

namespace WPSP\App\Components\NavigationMenus\Locations;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Components\NavigationMenus\Locations\BaseNavigationLocation;

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