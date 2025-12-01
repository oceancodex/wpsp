<?php

namespace WPSP\App\Instances\Event;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Event extends \WPSPCORE\Event\Event {

	use InstancesTrait;

	/*
	 *
	 */

	public static function instance(): ?Event {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setEvent();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}