<?php

namespace WPSP\app\Traits;

use WPSP\app\Extras\Instances\Routes\MapRoutes;
use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\Funcs;

/**
 * @property \WPSP\Funcs                                      $funcs
 * @property \WPSP\app\Extras\Instances\Validation\Validation $validation
 * @property \WPSP\app\Extras\Instances\Routes\MapRoutes      $mapRoutes
 */
trait InstancesTrait {

	public $mainPath;
	public $rootNamespace;
	public $prefixEnv;

	public $funcs;
	public $validation;

	public $mapRoutes;

	public function beforeInstanceConstruct(): void {
		$this->funcs         = Funcs::instance();
		$this->mainPath      = $this->funcs->_getMainPath();
		$this->rootNamespace = $this->funcs->_getRootNamespace();
		$this->prefixEnv     = $this->funcs->_getPrefixEnv();
//		if (class_exists('WPSPCORE\Validation\Validation')) {
//			$this->validation = Validation::instance();
//		}
//		$this->mapRoutes     = MapRoutes::instance();
	}

}