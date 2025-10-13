<?php
namespace WPSP\app\Models;

use WPSP\app\Traits\InstancesTrait;

class PermissionsModel extends \WPSPCORE\Permission\Models\PermissionsModel {

	use InstancesTrait;

	protected $prefix = 'wp_wpsp_';

}
