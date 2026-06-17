<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Storage\Storage as StorageCore;

class Storage extends StorageCore {

	use InstancesTrait;

	/** @var StorageCore|null */
	public static $instance  = null;

	/**
	 * @return StorageCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setStorage();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}