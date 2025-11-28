<?php

namespace WPSP\App\Instances\Log;

use WPSP\App\Traits\InstancesTrait;

class Log extends \WPSPCORE\Log\Log {

	use InstancesTrait;

	/*
	 *
	 */

	/**
	 * @return null|static
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static();
		}
		return static::$instance;
	}

}