<?php

namespace WPSP\app\Workers\Auth;

use WPSP\Funcs;

class Auth extends \WPSPCORE\Auth\Auth {

	/*
	 *
	 */

	public static ?self $instance   = null;

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance()
				]
			));
		}
		return static::$instance;
	}

}