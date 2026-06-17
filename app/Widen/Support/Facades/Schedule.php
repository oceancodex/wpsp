<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Schedule\Schedule as ScheduleCore;

class Schedule extends ScheduleCore {

	use InstancesTrait;

	/** @var ScheduleCore|null */
	public static $instance  = null;

	/**
	 * @return ScheduleCore|null
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
//			$instance->setSchedule();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}