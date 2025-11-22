<?php

namespace WPSP\App\Instances\RateLimiter;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @mixin \Illuminate\Support\Facades\RateLimiter
 */
class RateLimiter extends \WPSPCORE\RateLimiter\RateLimiter {

	use InstancesTrait;

	/** @var null|static */
	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

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