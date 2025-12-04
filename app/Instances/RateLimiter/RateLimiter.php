<?php

namespace WPSP\App\Instances\RateLimiter;

use WPSP\App\Instances\InstancesTrait;
use WPSP\Funcs;

/**
 * @mixin \Illuminate\Support\Facades\RateLimiter
 */
class RateLimiter extends \WPSPCORE\App\RateLimiter\RateLimiter {

	use InstancesTrait;

	/*
	 *
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