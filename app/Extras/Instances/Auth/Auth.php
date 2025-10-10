<?php

namespace WPSP\app\Extras\Instances\Auth;

use WPSP\Funcs;

class Auth extends \WPSPCORE\Auth\Auth {

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