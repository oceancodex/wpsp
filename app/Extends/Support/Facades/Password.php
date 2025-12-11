<?php

namespace WPSP\App\Extends\Support\Facades;

use WPSP\App\Extends\Traits\InstancesTrait;
use WPSP\Funcs;

class Password extends \WPSPCORE\App\Auth\Password {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setPassword();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}