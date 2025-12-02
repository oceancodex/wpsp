<?php

namespace WPSP\App\Instances\Database;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Migration extends \WPSPCORE\App\Database\Migration {

	use InstancesTrait;

	/*
	 *
	 */

	/**
	 * @return null|static
	 */
	public static function instance(): ?Migration {
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