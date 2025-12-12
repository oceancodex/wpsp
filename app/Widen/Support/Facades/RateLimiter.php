<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @mixin \Illuminate\Support\Facades\RateLimiter
 */
class RateLimiter extends \WPSPCORE\App\RateLimiter\RateLimiter {

	use InstancesTrait;

	public static $instance  = null;

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