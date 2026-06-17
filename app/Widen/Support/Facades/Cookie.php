<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Cookie\Cookie as CookieCore;

class Cookie extends CookieCore {

	use InstancesTrait;

	/** @var CookieCore|null */
	public static $instance  = null;

	/**
	 * @return CookieCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setCookie();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}