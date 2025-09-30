<?php

namespace WPSP\app\Extras\Instances\Auth;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Auth\Drivers\Database\User;

class Auth extends \WPSPCORE\Auth\Auth {

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