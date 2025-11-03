<?php

namespace WPSP\app\Workers\Events;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseInstances;

class Event extends BaseInstances {

	use InstancesTrait;

	public static $instance   = null;
	public        $dispatcher = null;

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
			))->boot();
		}
		return static::$instance;
	}

	public static function init() {
		return static::instance();
	}

	/**
	 * @return \WPSPCORE\Events\Event\Dispatcher|null
	 */
	public function dispatcher() {
		if (!$this->dispatcher && class_exists('WPSPCORE\Events\Event\Dispatcher')) {
			$this->dispatcher = new \WPSPCORE\Events\Event\Dispatcher();
		}
		return $this->dispatcher;
	}

	public function boot() {
		$map        = Funcs::config('events');
		$dispatcher = $this->dispatcher();
		if (is_array($map) && class_exists('WPSPCORE\Events\Event\EventServiceProvider')) {
			\WPSPCORE\Events\Event\EventServiceProvider::boot($map, $dispatcher);
		}
		return $this;
	}

}