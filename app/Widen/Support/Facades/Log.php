<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Log\Log as LogCore;

class Log extends LogCore {

	use InstancesTrait;

	/** @var LogCore|null */
	public static $instance  = null;

	/**
	 * @return LogCore|null
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