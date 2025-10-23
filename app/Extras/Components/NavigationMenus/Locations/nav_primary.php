<?php

namespace WPSP\app\Extras\Components\NavigationMenus\Locations;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseNavigationLocation;

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