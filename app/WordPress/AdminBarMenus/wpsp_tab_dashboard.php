<?php

namespace WPSP\App\WordPress\AdminBarMenus;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\AdminBarMenus\BaseAdminBarMenu;

class wpsp_tab_dashboard extends BaseAdminBarMenu {

	use InstancesTrait;

	// Args.
	public $id     = 'wpsp_tab_dashboard';
	public $title  = 'Tab: Dashboard';
	public $href   = '/wp-admin/admin.php?page=wpsp&tab=dashboard';
	public $parent = 'wpsp';
	public $meta   = [];


	/*
	 *
	 */

	public function customProperties() {
		$this->id    = 'wpsp_tab_dashboard';
		$this->title = 'Tab: Dashboard';
	}

}