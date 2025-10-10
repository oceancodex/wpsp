<?php

namespace WPSP\app\Traits;

use WPSP\Funcs;

trait InstancesTrait {

	protected function beforeInstanceConstruct(): void {
		$this->mainPath      = Funcs::getInstance()->_getMainPath();
		$this->rootNamespace = Funcs::getInstance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::getInstance()->_getPrefixEnv();
	}

}