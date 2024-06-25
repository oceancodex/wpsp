<?php

namespace WPSP\app\Extend\Components\NavigationMenus;

use WPSPCORE\Base\BaseNavigationMenu;

class TopNavigation extends BaseNavigationMenu {

	public mixed $prepareCurrentPostAndParent = false;

	public function __construct() {
		parent::__construct();
	}

}