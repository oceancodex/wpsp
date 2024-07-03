<?php

namespace WPSP\app\Extend\Instances\Database;

use WPSP\Funcs;

class Migration extends \WPSPCORE\Database\Migration {

	private static ?Migration $instance = null;

	public static function instance(): ?Migration {
		if (!self::$instance) {
			self::$instance = new Migration(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			);
		}
		return self::$instance;
	}

}