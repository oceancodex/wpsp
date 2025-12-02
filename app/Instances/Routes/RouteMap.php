<?php

namespace WPSP\App\Instances\Routes;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class RouteMap extends \WPSPCORE\app\Routes\RouteMap {

	use InstancesTrait;

	public static $instance = null;

	/**
	 * @return static
	 */
	public static function instance(): ?RouteMap {
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