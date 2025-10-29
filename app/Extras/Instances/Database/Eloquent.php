<?php

namespace WPSP\app\Extras\Instances\Database;

use WPSP\app\Extras\Instances\Environment\Environment;
use WPSP\Funcs;

class Eloquent extends \WPSPCORE\Database\Eloquent {

	public static function init() {
		(new static(
			Funcs::instance()->_getMainPath(),
			Funcs::instance()->_getRootNamespace(),
			Funcs::instance()->_getPrefixEnv(),
			[
				'environment'        => Environment::instance(),
				'validation'         => null,

				'prepare_funcs'      => true,
				'prepare_request'    => false,

				'unset_funcs'        => false,
				'unset_request'      => true,
				'unset_validation'   => true,
				'unset_environment'  => true,

				'unset_extra_params' => true,
			]
		))->global();
	}

}