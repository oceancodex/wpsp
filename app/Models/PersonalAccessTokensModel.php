<?php
namespace WPSP\App\Models;

use WPSP\App\Traits\InstancesTrait;

class PersonalAccessTokensModel extends \WPSPCORE\Sanctum\Models\PersonalAccessTokenModel {

	use InstancesTrait;

	protected $prefix = 'wp_wpsp_';
	
}
