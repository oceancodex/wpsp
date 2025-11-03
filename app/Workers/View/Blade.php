<?php

namespace WPSP\app\Workers\View;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Blade extends \WPSPCORE\View\Blade {

	use InstancesTrait;

	public static $instance = null;

	public static function instance($init = false) {
		if ($init && !static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[
					'funcs' => Funcs::instance(),
					'view_paths' => [
						Funcs::instance()->_getResourcesPath('/views')
					],
					'cache_path' => Funcs::instance()->_getStoragePath('/framework/views'),
				]
			);
		}
		return static::$instance;
	}

	public static function init() {
		return static::instance(true);
	}

}