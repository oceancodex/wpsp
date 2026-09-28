<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Cloud\Cloud as CloudCore;

class Cloud extends CloudCore {

	use InstancesTrait;

	/** @var CloudCore|null */
	public static $instance  = null;

	/**
	 * @return CloudCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setCloud();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}