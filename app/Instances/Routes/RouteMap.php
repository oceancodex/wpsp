<?php

namespace WPSP\app\Instances\Routes;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class RouteMap extends \WPSPCORE\Routes\RouteMap {

	use InstancesTrait;

	public static $instance = null;

	/**
	 * @return static
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
		}
		return static::$instance;
	}

}