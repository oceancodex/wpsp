<?php

namespace WPSP\app\Extras\Components\Roles;

use WPSPCORE\Base\BaseRole;

class super_admin extends BaseRole {

//	public $role         = 'super_admin';
	public $display_name = 'Super Admin';
	public $capabilities = [
		'edit_pages',
		'manage_options',
	];

	/*
	 *
	 */

	public function customProperties() {
//		$this->capabilities = [];
	}

}