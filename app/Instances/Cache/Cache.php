<?php

namespace WPSP\App\Instances\Cache;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Cache extends \WPSPCORE\app\Cache\Cache {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance(): ?Cache {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setCache();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}