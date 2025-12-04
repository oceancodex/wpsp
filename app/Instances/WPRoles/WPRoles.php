<?php

namespace WPSP\App\Instances\WPRoles;

use WPSP\App\Instances\InstancesTrait;
use WPSP\Funcs;

class WPRoles extends \WPSPCORE\App\WordPress\WPRoles\WPRoles {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance() {
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