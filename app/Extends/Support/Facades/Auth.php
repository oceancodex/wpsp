<?php

namespace WPSP\App\Extends\Support\Facades;

use WPSP\App\Extends\Traits\InstancesTrait;
use WPSP\Funcs;

class Auth extends \WPSPCORE\App\Auth\Auth {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance($guard = null) {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setAuth();
			static::$instance = $instance;
		}

		if ($guard && $guard !== 'web') {
			static::$instance->getAuth()->shouldUse($guard);
		}

		return static::$instance;
	}

}