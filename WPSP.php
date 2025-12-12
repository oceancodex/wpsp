<?php

namespace WPSP;

use Illuminate\View\View;
use WPSP\App\Widen\Exceptions\Handler as ExceptionsHandler;
use WPSP\App\Widen\Support\Facades\Auth;
use WPSP\App\Widen\Translation\WPTranslation;
use WPSP\App\Widen\Updater\Updater;
use WPSP\App\Widen\View\Share;

class WPSP extends \WPSPCORE\WPSP {

	public static ?WPSP $instance = null;

	/*
	 *
	 */

	public static function start() {
		$WPSP = static::instance();
		$WPSP->setApplication(__DIR__);
		static::aferSetupApplication();
	}

	public static function startConsole() {
		$WPSP = static::instance();
		$WPSP->setApplicationForConsole(__DIR__);
		static::aferSetupApplication();
		return $WPSP;
	}

	/*
	 *
	 */

	public static function instance() {
		if (!static::$instance) {
			$instance = new static(
				__DIR__,
				__NAMESPACE__,
				Funcs::PREFIX_ENV,
				[]
			);
			$instance->funcs = Funcs::instance();
			static::$instance = $instance;
		}
		return static::$instance;
	}

	/*
	 *
	 */

	public static function aferSetupApplication() {
		Updater::init();
		WPTranslation::init();
		static::shareVariablesForAllViews();
		static::overrideExceptionHandler();
	}

	/*
	 *
	 */

	public static function shareVariablesForAllViews() {
		Share::instance()->share();
		Share::instance()->compose();
	}

	/*
	 *
	 */

	public static function overrideExceptionHandler() {
		$existsExceptionHandler = get_exception_handler();
		if ($existsExceptionHandler instanceof ExceptionsHandler) return;
		set_exception_handler(function(\Throwable $e) {
			$handler = new ExceptionsHandler();
			$handler->report($e);
			$handler->render($e);
		});
	}

}