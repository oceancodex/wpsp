<?php

namespace WPSP\app\Traits;

use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\Funcs;

trait InstancesTrait {

	public function beforeConstruct(): void {
		$this->funcs         = Funcs::instance();
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
		$this->extraParams   = [
			'validation' => Validation::instance()
		];
	}

}