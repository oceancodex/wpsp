<?php

namespace WPSP\app\Extend\Instances\Database;

use WPSP\Funcs;

class Eloquent extends \WPSPCORE\Database\Eloquent {

	private static ?Eloquent $instance = null;

	public static function instance(): ?Eloquent {
		if (!self::$instance) {
			self::$instance = new Eloquent(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			);
		}
		return self::$instance;
	}

}