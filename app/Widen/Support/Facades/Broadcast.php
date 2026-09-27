<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Broadcast\Broadcast as BroadcastCore;

class Broadcast extends BroadcastCore {

	use InstancesTrait;

	/** @var BroadcastCore|null */
	public static $instance  = null;

	/**
	 * @return BroadcastCore|null
	 */
	public static function wpspInstance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setBroadcast();
			static::$instance = $instance;
		}
		return static::$instance;
	}

}