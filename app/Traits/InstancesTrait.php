<?php

namespace WPSP\App\Traits;

use WPSP\Funcs;

/**
 * @property \WPSP\Funcs                                      $funcs
 * @property \WPSP\App\Workers\Validation\Validation $validation
 * @property \WPSP\App\Workers\Routes\RouteMap      $routeMap
 */
trait InstancesTrait {

	public $funcs;
	public $mainPath;
	public $rootNamespace;
	public $prefixEnv;

	public function beforeInstanceConstruct(): void {
		$this->funcs         = Funcs::instance();
		$this->mainPath      = $this->funcs->_getMainPath();
		$this->rootNamespace = $this->funcs->_getRootNamespace();
		$this->prefixEnv     = $this->funcs->_getPrefixEnv();
	}

}