<?php

namespace WPSP\App\Instances\Routes;

use WPSP\Funcs;

/**
 * @method static get(string $action)
 * @method get(string $action)
 * @method static middleware(array|string $middlewares)
 */
class AjaxsRoute extends \WPSPCORE\Routes\AjaxsRoute {

	private static $instance = null;

	public static function instance() {
		if (!static::$instance) {
			static::$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public function _get($action, $callback, $nopriv = false, $useInitClass = false, $customProperties = null, $middlewares = null) {

	}

}