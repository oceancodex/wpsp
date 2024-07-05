<?php

namespace WPSP\app\Extend\Components\NavigationMenus\Locations;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseNavigationLocation;

class nav_primary extends BaseNavigationLocation {

	use InstancesTrait;

	// Args.
//	public ?string $location    = '';
	public ?string $description = 'Navigation primary';

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->location    = 'nav_primary';
//		$this->description = 'Primary navigation menu';
	}

}