<?php

namespace WPSP\App\Widen\Support\Facades;

use WPSP\App\Widen\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Request\Request as RequestCore;
use WPSPCORE\App\Widen\Http\Request as WPSPCORERequest;

if (class_exists('Illuminate\Http\Request')) {
	class Request extends RequestCore {

		use InstancesTrait;

		/** @var RequestCore|null */
		public static $instance = null;

		/**
		 * @return RequestCore|null
		 */
		public static function wpspInstance() {
			if (!static::$instance) {
				$instance = new static(
					Funcs::instance()->_getMainPath(),
					Funcs::instance()->_getRootNamespace(),
					Funcs::instance()->_getPrefixEnv(),
					[]
				);
				$instance->setFacade();
				static::$instance = $instance;
			}
			return static::$instance;
		}

	}
}
else {
	class Request extends WPSPCORERequest {}
}