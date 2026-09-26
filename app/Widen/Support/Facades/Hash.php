<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Hash\Hash as HashCore;

class Hash extends HashCore {

	use InstancesTrait;

	/** @var HashCore|null */
	public static $instance  = null;

	/**
	 * @return HashCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setHash();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}