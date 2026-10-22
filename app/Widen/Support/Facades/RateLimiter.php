<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Support\Facades\RateLimiter as RateLimiterCore;

/**
 * @mixin \Illuminate\Support\Facades\RateLimiter
 */
class RateLimiter extends RateLimiterCore {

	use InstancesTrait;

	/** @var RateLimiterCore|null */
	public static $instance = null;

	/**
	 * @return RateLimiterCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$funcs = Funcs::instance();

			static::$instance = new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[]
			);

			static::$instance->setFacade();
		}

		return static::$instance;
	}

}
