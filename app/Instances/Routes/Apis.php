<?php

namespace WPSP\App\Instances\Routes;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Apis extends \WPSPCORE\Routes\Apis\Apis {

	use InstancesTrait;

//	public static string $defaultNamespace = 'wpsp';
	public static string $defaultVersion   = 'v1';

	/*
	 *
	 */

	public function afterConstruct() {
		static::$defaultNamespace = Funcs::instance()->_getAppShortName();
	}

}