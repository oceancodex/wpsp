<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Support\Facades\Validator as ValidatorCore;

class Validator extends ValidatorCore {

	use InstancesTrait;

	/** @var ValidatorCore|null */
	public static $instance  = null;

	/**
	 * @return ValidatorCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$funcs = Funcs::instance();

			static::$instance = new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[]
			);

			static::$instance->setFacade();
		}

		return static::$instance;
	}

}