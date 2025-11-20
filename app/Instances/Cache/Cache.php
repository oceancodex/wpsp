<?php

namespace WPSP\App\Instances\Cache;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

/**
 * @mixin \Illuminate\Cache\CacheManager
 * @mixin \Illuminate\Support\Facades\Cache
 */
class Cache extends \WPSPCORE\Cache\Cache {

	use InstancesTrait;

	/** @var null|static */
	private static $instance = null;

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
			$instance->setCache();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}