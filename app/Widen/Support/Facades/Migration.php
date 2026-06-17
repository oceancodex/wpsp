<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Database\Migration as MigrationCore;

class Migration extends MigrationCore {

	use InstancesTrait;

	/** @var MigrationCore|null */
	public static $instance  = null;

	/**
	 * @return MigrationCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			));
		}
		return static::$instance;
	}

}