<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Session\Session as SessionCore;

class Session extends SessionCore {

	use InstancesTrait;

	/** @var SessionCore|null */
	public static $instance  = null;

	/**
	 * @return SessionCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setSession();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}