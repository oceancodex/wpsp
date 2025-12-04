<?php

namespace WPSP;

use Illuminate\View\View;
use WPSP\App\Instances\Auth\Auth;
use WPSP\App\Instances\Exceptions\Handler as ExceptionsHandler;

class WPSP extends \WPSPCORE\WPSP {

	public static ?WPSP $instance = null;

	/*
	 *
	 */

	public static function start() {
		$WPSP = static::instance();
		$WPSP->setApplication(__DIR__);
		static::viewShare($WPSP);
		static::overrideExceptionHandler();
	}

	public static function startConsole() {
		$WPSP = static::instance();
		$WPSP->setApplicationForConsole(__DIR__);
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

	/*
	 *
	 */

	public static function viewShare(WPSP $WPSP) {
		$view    = $WPSP->getApplication('view');
		$request = $WPSP->getApplication('request');

		$view->share([
			'wp_user'         => wp_get_current_user(),
			'current_request' => $request,
			'user'            => Auth::user(),
		]);

		$view->composer('*', function(View $view) {
			global $notice;
			$view->with('current_view_name', $view->getName());
			$view->with('notice', $notice);
		});
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