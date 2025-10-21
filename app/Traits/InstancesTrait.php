<?php

namespace WPSP\app\Traits;

use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\Funcs;

trait InstancesTrait {

	public function beforeInstanceConstruct(): void {
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
		$this->funcs         = Funcs::instance();
		$this->validation    = Validation::init();
	}

}