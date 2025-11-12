<?php

namespace WPSP\App\Traits;

use WPSP\Funcs;

/**
 * @property \WPSP\Funcs                             $funcs
 * @property \WPSP\App\Workers\Validation\Validation $validation
 * @property \WPSP\App\Workers\Routes\RouteMap       $routeMap
 */
trait InstancesTrait {

	public function beforeConstruct(): void {
		$funcs               = Funcs::instance();
		$this->funcs         = $funcs;
		$this->mainPath      = $funcs->_getMainPath();
		$this->rootNamespace = $funcs->_getRootNamespace();
		$this->prefixEnv     = $funcs->_getPrefixEnv();
	}

}