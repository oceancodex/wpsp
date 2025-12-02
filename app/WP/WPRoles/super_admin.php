<?php

namespace WPSP\App\WP\WPRoles;

use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\app\WP\WPRoles\BaseWPRole;

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