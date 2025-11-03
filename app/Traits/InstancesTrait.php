<?php

namespace WPSP\app\Traits;

use WPSP\app\WPSP\Routes\RouteMap;
use WPSP\app\WPSP\Validation\Validation;
use WPSP\Funcs;

/**
 * @property \WPSP\Funcs                                      $funcs
 * @property \WPSP\app\WPSP\Validation\Validation $validation
 * @property \WPSP\app\WPSP\Routes\RouteMap      $routeMap
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