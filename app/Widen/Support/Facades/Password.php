<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Auth\Password as PasswordCore;

class Password extends PasswordCore {

	use InstancesTrait;

	/** @var PasswordCore|null */
	public static $instance  = null;

	/**
	 * @return PasswordCore|null
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