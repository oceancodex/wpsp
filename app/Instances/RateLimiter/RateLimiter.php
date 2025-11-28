<?php

namespace WPSP\App\Instances\RateLimiter;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @mixin \Illuminate\Support\Facades\RateLimiter
 */
class RateLimiter extends \WPSPCORE\RateLimiter\RateLimiter {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance(): ?RateLimiter {
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