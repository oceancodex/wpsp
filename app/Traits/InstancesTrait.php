<?php

namespace WPSP\app\Traits;

use WPSP\app\Extras\Instances\Validation\Validation;
use WPSP\Funcs;
use WPSP\routes\MapRoutes;

/**
 * @property \WPSP\Funcs $funcs
 * @property \WPSP\app\Extras\Instances\Validation\Validation $validation
 * @property \WPSP\routes\MapRoutes $mapRoutes
 */
trait InstancesTrait {

	public $mainPath;
	public $rootNamespace;
	public $prefixEnv;
	public $funcs;
	public $validation;
	public $mapRoutes;

	public function beforeInstanceConstruct(): void {
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
		$this->funcs         = Funcs::instance();
		$this->validation    = Validation::init();
		$this->mapRoutes     = MapRoutes::instance();
	}

}