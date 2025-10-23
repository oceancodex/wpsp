<?php

namespace WPSP\app\Extras\Instances\Database;

use WPSP\Funcs;

class Eloquent extends \WPSPCORE\Database\Eloquent {

	public static function init() {
		(new static(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv(),
			[
				'prepare_funcs'   => true,
				'prepare_request' => true,
			]
		))->global();
	}

}