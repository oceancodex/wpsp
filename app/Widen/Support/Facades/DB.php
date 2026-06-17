<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Database\DB as DBCore;

class DB extends DBCore {

	use InstancesTrait;

	/** @var DBCore|null */
	public static $instance  = null;

	/**
	 * @return DBCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setDB();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}