<?php

namespace OCBP\app\Components\NavigationMenus;

use OCBPCORE\Base\BaseNavigationMenu;

class TopNavigation extends BaseNavigationMenu {

	public mixed $prepareCurrentPostAndParent = false;

	public function __construct() {
		parent::__construct();
	}

}