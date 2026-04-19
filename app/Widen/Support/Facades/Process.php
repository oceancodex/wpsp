<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;

class Process extends \WPSPCORE\App\Process\Process {

	use InstancesTrait;

	public static $instance  = null;

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