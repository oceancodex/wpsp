<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Process\Process as ProcessCore;

class Process extends ProcessCore {

	use InstancesTrait;

	/** @var ProcessCore|null */
	public static $instance  = null;

	/**
	 * @return ProcessCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setProcess();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}