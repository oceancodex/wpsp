<?php

namespace WPSP\app\Extend\Instances\Database;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Eloquent extends \WPSPCORE\Database\Eloquent {

	use InstancesTrait;

	public static function init(): void {
		self::instance(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv()
		);
	}

}