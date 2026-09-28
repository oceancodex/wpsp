<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\App\App as AppCore;

class App extends AppCore {

	use InstancesTrait;

	/** @var AppCore|null */
	public static $instance  = null;

	/**
	 * @return AppCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setFacade();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}