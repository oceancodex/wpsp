<?php

namespace WPSP\App\Workers\View;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Blade extends \WPSPCORE\View\Blade {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-view')) {
			return static::instance(true);
		}
		return null;
	}

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

}