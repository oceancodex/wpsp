<?php
namespace WPSP\app\Models;

use WPSP\app\Traits\InstancesTrait;

class RolesModel extends \WPSPCORE\Permission\Models\RolesModel {

	use InstancesTrait;

	protected $prefix = 'wp_wpsp_';
	
}
