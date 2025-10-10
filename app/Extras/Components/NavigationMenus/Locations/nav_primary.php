<?php

namespace WPSP\app\Extras\Components\NavigationMenus\Locations;

use WPSPCORE\Base\BaseNavigationLocation;

class nav_primary extends BaseNavigationLocation {

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