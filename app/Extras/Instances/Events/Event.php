<?php

namespace WPSP\app\Extras\Instances\Events;

use WPSP\Funcs;
use WPSPCORE\Events\Event\Dispatcher;
use WPSPCORE\Events\Event\EventServiceProvider;

class Event {

	public static $dispatcher = null;

	public static function init() {
		$map        = Funcs::config('events');
		$dispatcher = static::dispatcher();
		if (is_array($map)) {
			EventServiceProvider::boot($map, $dispatcher);
		}
	}

	public static function dispatcher() {
		if (static::$dispatcher === null) {
			static::$dispatcher = new Dispatcher();
		}
		return static::$dispatcher;
	}

}