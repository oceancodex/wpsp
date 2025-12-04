<?php

namespace WPSP\App\Instances;

use WPSP\Funcs;

trait InstancesTrait {

	public static $instance = null;

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public function instanceConstruct() {
		$funcs               = Funcs::instance();
		$this->funcs         = $funcs;
		$this->mainPath      = $funcs->_getMainPath();
		$this->rootNamespace = $funcs->_getRootNamespace();
		$this->prefixEnv     = $funcs->_getPrefixEnv();
	}

}