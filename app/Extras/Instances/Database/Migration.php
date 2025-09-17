<?php

namespace WPSP\app\Extras\Instances\Database;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Migration extends \WPSPCORE\Migration\Migration {

	use InstancesTrait;

	public static function init(): void {
		(new static(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv()
		))->global();
	}

}