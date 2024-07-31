<?php

namespace WPSP\app\Extend\Instances\ErrorHandler;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseInstances;

class ErrorHandler extends BaseInstances {

	use InstancesTrait;

	public static ?self $instance = null;

	public static function init(): void {
		try {
			if (Funcs::config('app.debug') !== 'false') {
				$type = Funcs::config('app.debug_type');
				if ($type == 'advanced') {
					Ignition::init();
				}
				else {
					Debug::init();
				}
			}
		}
		catch (\Exception|\Throwable $e) {
			Funcs::notice($e->getMessage(), 'error');
		}
	}

	public static function instance(): ?self {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv()
			));
		}
		return static::$instance;
	}

}