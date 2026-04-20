<?php

namespace WPSP\App\WordPress\AdminBarMenus;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\AdminBarMenus\BaseAdminBarMenu;

class wpsp extends BaseAdminBarMenu {

	use InstancesTrait;

	// Args.
	public $id     = 'wpsp';
	public $title  = 'WPSP';
	public $href   = 'admin.php?page=wpsp';
	public $parent = null;
	public $meta   = [];


	/*
	 *
	 */

	public function customProperties() {
		$this->id    = 'wpsp';
		$this->title = '<span class="ab-icon dashicons dashicons-analytics" style="padding: 6px 0;"></span><span class="ab-label">WPSP</span>';
	}

}