<?php

namespace WPSP\App\Instances\Routes;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Apis extends \WPSPCORE\Routes\Apis\Apis {

	use InstancesTrait;

//	public string $defaultNamespace = 'wpsp';
	public string $defaultVersion   = 'v1';

	/*
	 *
	 */

	public function afterConstruct() {
		$this->defaultNamespace = Funcs::instance()->_getAppShortName();
	}

}