<?php

namespace WPSP\App\WordPress\WPRoles;

use WPSP\App\Instances\InstancesTrait;
use WPSPCORE\App\WordPress\WPRoles\BaseWPRole;

class super_admin extends BaseWPRole {

	use InstancesTrait;

//	public $role         = 'super_admin';
	public $display_name = 'Super Admin';
	public $capabilities = [
		'edit_pages',
		'manage_options',
//		'edit_themes',
	];

	/*
	 *
	 */

	public function customProperties() {
//		$this->capabilities = [];
	}

}