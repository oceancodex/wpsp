<?php

namespace WPSP\App\Instances\Auth;

use WPSP\App;

/**
 * @mixin \Illuminate\Support\Facades\Auth
 */
class Auth {

	/*
	 *
	 */

	public static $instance   = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = App::instance()->application()->make('auth');
		}
		return static::$instance;
	}

	public static function __callStatic($name, $arguments) {
		return static::instance()->$name(...$arguments);
	}

}