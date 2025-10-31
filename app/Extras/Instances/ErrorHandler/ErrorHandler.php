<?php

namespace WPSP\app\Extras\Instances\ErrorHandler;

use WPSP\Funcs;
use WPSPCORE\Base\BaseInstances;

class ErrorHandler extends BaseInstances {

	public static ?self $instance = null;

	public static function init() {
		try {
			if (Funcs::config('app.debug') !== 'false') {
				$type = Funcs::config('app.debug_type');
				if ($type == 'advanced' && class_exists('\WPSPCORE\ErrorHandler\Ignition')) {
					Ignition::init();
				}
				else {
					Debug::init();
				}
			}
		}
		catch (\Throwable $e) {
			Funcs::notice($e->getMessage(), 'error');
		}
	}

	public static function instance() {
		if (!static::$instance) {
			static::$instance = (new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'prepare_funcs'   => true,
					'prepare_request' => true,
				]
			));
		}
		return static::$instance;
	}

}