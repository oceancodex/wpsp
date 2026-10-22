<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Support\Facades\Auth as AuthCore;

class Auth extends AuthCore {

	use InstancesTrait;

	/** @var AuthCore|null */
	public static $instance  = null;

	/**
	 * @return AuthCore|null
	 */
	public static function wpspInstance($guard = null) {
		if (!static::$instance) {
			$funcs = Funcs::instance();

			static::$instance = new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[]
			);

			static::$instance->setFacade();
		}

		if ($guard && $guard !== 'web') {
			static::$instance->getAuth()->shouldUse($guard);
		}

		return static::$instance;
	}

}