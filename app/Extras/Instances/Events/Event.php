<?php

namespace WPSP\app\Extras\Instances\Events;

use WPSP\Funcs;

class Event {

	public static $dispatcher = null;

	public static function init() {
		$map        = Funcs::config('events');
		$dispatcher = static::dispatcher();
		if (is_array($map)) {
			\WPSPCORE\Events\Event\EventServiceProvider::boot($map, $dispatcher);
		}
	}

	/**
	 * @return \WPSPCORE\Events\Event\Dispatcher|null
	 */
	public static function dispatcher() {
		if (static::$dispatcher === null) {
			static::$dispatcher = new \WPSPCORE\Events\Event\Dispatcher();
		}
		return static::$dispatcher;
	}

}