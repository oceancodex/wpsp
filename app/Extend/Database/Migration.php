<?php

namespace WPSP\app\Extend\Database;

use WPSP\Funcs;

class Migration extends \WPSPCORE\Database\Migration {

	private static ?Migration $instance = null;

	public static function instance(): ?Migration {
		if (!self::$instance) {
			$mainPath = Funcs::instance()->getMainPath();
			$rootNamespace = Funcs::instance()->getRootNamespace();
			self::$instance = new Migration($mainPath, $rootNamespace);
		}
		return self::$instance;
	}

}