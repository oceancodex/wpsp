<?php

namespace WPSP\App\Extends\Support\Facades;

use WPSP\App\Extends\Traits\InstancesTrait;
use WPSP\Funcs;

class Log extends \WPSPCORE\App\Log\Log {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setLog();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}