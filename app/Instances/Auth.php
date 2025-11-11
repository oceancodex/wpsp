<?php

namespace WPSP\App\Workers\Auth;

use WPSP\Funcs;

class Auth extends \WPSPCORE\Auth\Auth {

	/*
	 *
	 */

	public static ?self $instance   = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-auth')) {
			if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
				session_start();
			}
			return static::instance(true);
		}
		return null;
	}

	public static function instance($init = false) {
		if ($init && !static::$instance) {
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