<?php

namespace WPSP\app\Extras\Instances\Sanctum;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Sanctum extends \WPSPCORE\Sanctum\Sanctum {

	use InstancesTrait;

	/*
	 *
	 */

	public static ?self $instance   = null;

	/*
	 *
	 */

	public static function instance(): ?self {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return static::$instance;
	}

}