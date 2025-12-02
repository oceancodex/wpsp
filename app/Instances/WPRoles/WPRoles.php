<?php

namespace WPSP\App\Instances\WPRoles;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class WPRoles extends \WPSPCORE\App\WP\WPRoles\WPRoles {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance(): ?WPRoles {
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