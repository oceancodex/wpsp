<?php

namespace WPSP\App\WordPress\WPRoles;

use WPSP\App\Instances\InstancesTrait;
use WPSPCORE\App\WordPress\WPRoles\BaseWPRole;

class super_admin extends BaseWPRole {

	use InstancesTrait;

//	public ?string $role         = 'super_admin';
	public ?string $display_name = 'Super Admin';
	public array   $capabilities = [
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