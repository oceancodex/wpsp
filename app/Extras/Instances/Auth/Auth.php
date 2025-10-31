<?php

namespace WPSP\app\Extras\Instances\Auth;

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
					'funcs'              => Funcs::instance(),
					'environment'        => null,
					'validation'         => null,

					'prepare_funcs'      => true,
					'prepare_request'    => false,

					'unset_funcs'        => false,
					'unset_request'      => true,
					'unset_validation'   => true,
					'unset_environment'  => true,

					'unset_extra_params' => true,
				]
			));
		}
		return static::$instance;
	}

}