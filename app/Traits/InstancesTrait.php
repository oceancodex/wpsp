<?php

namespace WPSP\App\Traits;

use WPSP\Funcs;
use WPSP\WPSP;

trait InstancesTrait {

	public function beforeConstruct(): void {
		$funcs                 = Funcs::instance();
		static::$funcs         = $funcs;
		static::$mainPath      = $funcs->_getMainPath();
		static::$rootNamespace = $funcs->_getRootNamespace();
		static::$prefixEnv     = $funcs->_getPrefixEnv();
	}

}