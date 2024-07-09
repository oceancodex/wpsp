<?php

namespace WPSP\app\Extend\Instances\Database;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Migration extends \WPSPCORE\Database\Migration {

	use InstancesTrait;

	public static function init(): void {
		(new self(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv()
		))->global();
	}

}