<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Queue\Queue as QueueCore;

class Queue extends QueueCore {

	use InstancesTrait;

	/** @var QueueCore|null */
	public static $instance  = null;

	/**
	 * @return QueueCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setQueue();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}