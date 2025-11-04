<?php

namespace WPSP\app\Components\Roles;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRole;

class super_admin extends BaseRole {

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