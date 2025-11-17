<?php

namespace WPSP\App\Instances\Database;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Migration extends \WPSPCORE\Database\Migration {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	/*
	 *
	 */

	/**
	 * @return null|static
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