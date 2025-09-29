<?php

namespace WPSP\app\Extras\Components\Roles;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRole;

class super_admin extends BaseRole {

	use InstancesTrait;

//	public mixed $role         = 'super_admin';
	public mixed $display_name = 'Super Admin';
	public mixed $capabilities = [
		'edit_pages',
		'manage_options',
	];

	/*
	 *
	 */

	public function customProperties(): void {
//		$this->capabilities = [];
	}

}