<?php

namespace WPSP\App\Widen\Traits;

use WPSP\Funcs;

trait InstancesTrait {

	public static $instances = [];

	/**
	 * @return static
	 */
	public static function instance() {
		$class = static::class;

		if (!isset(self::$instances[$class])) {
			$funcs = Funcs::instance();

			self::$instances[$class] = new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[]
			);
		}

		return self::$instances[$class];
	}

	/*
	 *
	 */

	public function beforeInstanceConstruct() {
		$funcs               = Funcs::instance();
		$this->funcs         = $funcs;
		$this->mainPath      = $funcs->_getMainPath();
		$this->rootNamespace = $funcs->_getRootNamespace();
		$this->prefixEnv     = $funcs->_getPrefixEnv();
	}

}