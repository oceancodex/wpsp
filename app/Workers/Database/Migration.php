<?php

namespace WPSP\app\Workers\Database;

use WPSP\app\Workers\Environment\Environment;
use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Migration extends \WPSPCORE\Migration\Migration {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-migration')) {
			return static::instance(true);
		}
		return null;
	}

	/*
	 *
	 */

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
					'funcs'       => Funcs::instance(),
				]
			));

			static::$instance->global();
		}
		return static::$instance;
	}

}