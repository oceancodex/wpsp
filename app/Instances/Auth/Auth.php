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

	/** @var static|null */
	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	/**
	 * @return null|static
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