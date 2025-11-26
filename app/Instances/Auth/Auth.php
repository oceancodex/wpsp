<?php

namespace WPSP\App\Instances\Auth;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @mixin \Illuminate\Support\Facades\Auth
 */
class Auth extends \WPSPCORE\Auth\Auth {

	use InstancesTrait;

	/*
	 *
	 */

	public static ?Auth $instance = null;

	/*
	 *
	 */

	public static function instance($guard = null): ?Auth {
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