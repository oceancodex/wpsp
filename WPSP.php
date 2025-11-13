<?php

namespace WPSP;

use Illuminate\View\View;
use WPSP\App\Instances\Auth\Auth;
use WPSP\App\Instances\Exceptions\Handler as ExceptionsHandler;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseWPSP;

class WPSP extends BaseWPSP {

	use InstancesTrait;

	public static $instance = null;

	/*
	 *
	 */

	public static function init() {
		$WPSP = static::instance();
		$WPSP->handleRequest();
		$WPSP->restoreSessionsForWordPress();
		static::viewShare($WPSP);
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
//		add_action('init', function() use ($WPSP) {
			$view    = $WPSP->getApplication('view');

			$view->share([
				'wp_user'         => wp_get_current_user(),
				'user'            => Auth::user(),
			]);

			$view->composer('*', function(View $view) {
				global $notice;
				$view->with('current_view_name', $view->getName());
				$view->with('notice', $notice);
			});
//		});
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