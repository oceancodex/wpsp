<?php
namespace WPSP\App\Models;

use WPSP\App\Traits\InstancesTrait;

class PermissionsModel extends \WPSPCORE\Permission\Models\PermissionsModel {

	use InstancesTrait;

	protected $prefix = 'wp_wpsp_';

}
