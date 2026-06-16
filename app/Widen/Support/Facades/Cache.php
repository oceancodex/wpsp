<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Cache\Cache as CacheCore;

class Cache extends CacheCore {

	use InstancesTrait;

	/** @var CacheCore|null */
	public static $instance  = null;

	/**
	 * @return CacheCore|null
	 */
	public static function instance() {
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