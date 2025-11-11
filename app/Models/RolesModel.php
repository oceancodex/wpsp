<?php
namespace WPSP\App\Models;

use WPSP\App\Traits\InstancesTrait;

class RolesModel extends \WPSPCORE\Permission\Models\RolesModel {

	use InstancesTrait;

	protected $prefix = 'wp_wpsp_';
	
}
