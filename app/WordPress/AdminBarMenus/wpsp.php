<?php

namespace WPSP\App\WordPress\AdminBarMenus;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSPCORE\App\WordPress\UserMetaBoxes\PostTypeColumns\BaseAdminBarMenu;

class wpsp extends BaseAdminBarMenu {

	use InstancesTrait;

	// Args.
	public $name   = 'wpsp';
	public $title  = 'WPSP';
	public $href   = '/wp-admin/admin.php?page=wpsp';
	public $parent = '';
	public $meta   = [];


	/*
	 *
	 */

	public function customProperties() {
		$this->id    = 'wpsp';
		$this->title = '<span class="ab-icon dashicons dashicons-analytics" style="padding: 6px 0;"></span><span class="ab-label">WPSP</span>';
	}

}