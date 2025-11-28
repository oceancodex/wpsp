<?php

namespace WPSP\App\WP\WPRoles;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\WP\WPRoles\BaseWPRole;

class super_admin extends BaseWPRole {

	use InstancesTrait;

//	public ?string $role         = 'super_admin';
	public ?string $display_name = 'Super Admin';
	public array   $capabilities = [
		'edit_pages',
		'manage_options'
	];

	/*
	 *
	 */

	public function customProperties() {
//		$this->capabilities = [];
	}

}