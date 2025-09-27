<?php

namespace WPSP\app\Extras\Instances\Auth;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Auth extends \WPSPCORE\Auth\Auth {

	use InstancesTrait;

	/*
	 *
	 */

	public static ?self $instance = null;

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

	/*
	 *
	 */

	public static function user() {
		return static::instance()->guard()->user();
	}

	public static function check(): bool {
		return static::instance()->guard()->check();
	}

	public static function logout(): void {
		static::instance()->guard()->logout();
	}

	public static function id(): ?int {
		return static::instance()->guard()->id();
	}

}