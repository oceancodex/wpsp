<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\RateLimiter\RateLimiter as RateLimiterCore;

/**
 * @mixin \Illuminate\Support\Facades\RateLimiter
 */
class RateLimiter extends RateLimiterCore {

	use InstancesTrait;

	/** @var RateLimiterCore|null */
	public static $instance  = null;

	/**
	 * @return RateLimiterCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			));
			$instance->setRateLimiter();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}