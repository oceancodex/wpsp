<?php

namespace WPSP\App\Instances\RateLimiter;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class RateLimiter {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static());
		}
		return static::$instance;
	}

}