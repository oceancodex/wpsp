<?php

namespace WPSP\App\Components\Roles;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Components\WPRoles\BaseWPRole;

class super_admin extends BaseWPRole {

	use InstancesTrait;

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