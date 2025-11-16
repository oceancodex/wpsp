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
	public static function instance() {
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
		return static::$instance;
	}

	public static function __callStatic($name, $arguments) {
		if (method_exists(static::instance(), $name)) {
			return static::instance()->$name(...$arguments);
		}
		else {
			return static::instance()->getAuth()->$name(...$arguments);
		}
	}

}