<?php

namespace WPSP;

use Illuminate\View\View;
use WPSP\App\Instances\Auth\Auth;
use WPSP\App\Instances\Exceptions\Handler as ExceptionsHandler;
use WPSPCORE\Base\BaseWPSP;

class WPSP extends BaseWPSP {

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		$WPSP = static::instance();
		$app = $WPSP->getApplication();
		static::viewShare($WPSP);
		static::overrideExceptionHandler();
	}

	/**
	 * @return null|static
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
			$instance->setApplication(__DIR__);
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

	/**
	 * @param static $WPSP
	 */
	public static function viewShare($WPSP): void {
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

	public static function overrideExceptionHandler(): void {
		$existsExceptionHandler = get_exception_handler();
		if ($existsExceptionHandler instanceof ExceptionsHandler) return;
		set_exception_handler(function(\Throwable $e) {
			$handler = new ExceptionsHandler();
			$handler->report($e);
			$handler->render($e);
		});
	}

}