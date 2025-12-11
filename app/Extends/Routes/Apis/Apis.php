<?php

namespace WPSP\App\Extends\Routes\Apis;

use WPSP\App\Extends\Traits\InstancesTrait;
use WPSP\Funcs;

class Apis extends \WPSPCORE\App\Routes\Apis\Apis {

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