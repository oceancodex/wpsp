<?php

namespace WPSP\App\Workers\Events;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class Events extends \WPSPCORE\Events\Events {

	use InstancesTrait;

	public static $instance   = null;
	public        $dispatcher = null;

	/*
	 *
	 */

	public static function init() {
		if (Funcs::vendorFolderExists('oceancodex/wpsp-events')) {
			return static::instance(true);
		}
		return null;
	}

	/*
	 *
	 */

	public static function instance($init = false) {
		if ($init && !static::$instance) {
			$funcs = Funcs::instance();
			static::$instance = (new static(
				$funcs->_getMainPath(),
				$funcs->_getRootNamespace(),
				$funcs->_getPrefixEnv(),
				[
					'funcs' => $funcs,
				]
			));
			static::$instance->boot();
		}
		return static::$instance;
	}

	/*
	 *
	 */

}