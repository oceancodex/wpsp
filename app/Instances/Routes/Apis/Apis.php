<?php

namespace WPSP\App\Instances\Routes\Apis;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Apis extends \WPSPCORE\Routes\Apis\Apis {

	use InstancesTrait;

//	public $defaultNamespace = 'wpsp';
	public $defaultVersion   = 'v1';

	/*
	 *
	 */

	public function afterConstruct() {
		$this->defaultNamespace = Funcs::instance()->_getAppShortName();
	}

}