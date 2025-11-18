<?php

namespace WPSP\App\Instances\Database;

use WPSP\App\Instances\Container\Container;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Eloquent extends \WPSPCORE\Database\Eloquent {

	use InstancesTrait;

	/*
	 *
	 */

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-database')) {
			static::$instance = static::instance(true);

			// Set event dispatcher for Eloquent models.
			$container = Container::instance();
			if ($container) {
				$useMongoDB = Funcs::vendorFolderExists('oceancodex/wpsp-mongodb');
				Container::bootEvent($container, $useMongoDB);
			}

			return static::$instance;
		}
		return null;
	}

	/**
	 * @return null|static
	 */
	public static function instance($init = false) {
		if ($init && !static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
				]
			));
			static::$instance->global();
		}
		return static::$instance;
	}

}