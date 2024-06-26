<?php

namespace WPSP\app\Traits;

use WPSP\Funcs;

trait InstancesTrait {

	public function beforeInstanceConstruct(): void {
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
	}

}