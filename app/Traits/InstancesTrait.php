<?php

namespace WPSP\App\Traits;

use WPSP\Funcs;
use WPSP\WPSP;

/**
 * @property \WPSP\Funcs                             $funcs
 * @property \WPSP\App\Workers\Validation\Validation $validation
 * @property \WPSP\App\Workers\Routes\RouteMap       $routeMap
 */
trait InstancesTrait {

	public function beforeConstruct(): void {
		$funcs               = Funcs::instance();
		$this->funcs         = $this->funcs ?: $funcs;
		$this->mainPath      = $this->mainPath ?: $funcs->_getMainPath();
		$this->rootNamespace = $this->rootNamespace ?: $funcs->_getRootNamespace();
		$this->prefixEnv     = $this->prefixEnv ?: $funcs->_getPrefixEnv();
	}

}