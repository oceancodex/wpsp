<?php

namespace WPSP\app\WPSP\View;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;

class Blade extends \WPSPCORE\View\Blade {

	use InstancesTrait;

	public static $instance = null;

	public static function instance() {
		if (static::$instance === null) {
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
		return static::instance();
	}

}