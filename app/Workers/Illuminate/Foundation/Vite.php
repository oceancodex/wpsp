<?php
namespace Illuminate\Foundation;

use WPSP\Funcs;

class Vite extends \WPSPCORE\View\Vite {

	public function __construct() {
		$this->mainPath      = Funcs::instance()->_getMainPath();
		$this->rootNamespace = Funcs::instance()->_getRootNamespace();
		$this->prefixEnv     = Funcs::instance()->_getPrefixEnv();
		parent::__construct();
	}

}