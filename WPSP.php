<?php

namespace WPSP;

use WPSP\App\Instances\Exceptions\Handler as ExceptionsHandler;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseWPSP;

class WPSP extends BaseWPSP {

	use InstancesTrait;

	protected static $instance = null;

	/*
	 *
	 */

	public static function init() {
		return static::instance();
	}

	/**
	 * @return null|static
	 */
	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				Funcs::instance()->_getMainPath(),
				Funcs::instance()->_getRootNamespace(),
				Funcs::instance()->_getPrefixEnv(),
				[]
			);
			$instance->setApplication(__DIR__);
			static::$instance = $instance;
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public static function overrideExceptionHandler(): void {
		$existsExceptionHandler = get_exception_handler();

		if ($existsExceptionHandler instanceof ExceptionsHandler) {
			return;
		}

		set_exception_handler(function(\Throwable $e) {
			$handler = new ExceptionsHandler();
			$handler->report($e);
			$handler->render($e);
		});
	}

}