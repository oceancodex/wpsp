<?php

namespace WPSP\app\WPSP\Database;

use WPSP\app\WPSP\Environment\Environment;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Eloquent extends \WPSPCORE\Database\Eloquent {

	use InstancesTrait;

	public static $instance = null;

	/**
	 * @return null|static
	 */
	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs'       => Funcs::instance(),
//					'migration'   => Migration::instance(),
//					'environment' => Environment::instance(),
				]
			));
		}
		return static::$instance;
	}

	public static function init() {
		return static::instance();
	}

}