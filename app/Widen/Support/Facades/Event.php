<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Events\Events as EventsCore;

class Event extends EventsCore {

	use InstancesTrait;

	/** @var EventsCore|null */
	public static $instance  = null;

	/**
	 * @return EventsCore|null
	 */
	public static function instance() {
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