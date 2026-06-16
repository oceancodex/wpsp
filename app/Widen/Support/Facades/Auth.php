<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Auth\Auth as AuthCore;

class Auth extends AuthCore {

	use InstancesTrait;

	/** @var AuthCore|null */
	public static $instance  = null;

	/**
	 * @return AuthCore|null
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