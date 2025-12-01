<?php

namespace WPSP\App\Instances\Events;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Events extends \WPSPCORE\Events\Events {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance(): ?Events {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setEvents();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}