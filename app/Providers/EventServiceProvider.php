<?php
namespace WPSP\app\Providers;

use WPSP\app\Listeners\LogWrittenListener;

class EventServiceProvider extends \WPSPCORE\Events\Event\EventServiceProvider {

	public static function boot($map, $dispatcher) {
		parent::boot($map, $dispatcher);
		$dispatcher->listen('logging.written', [LogWrittenListener::class, 'handle']);
	}

}