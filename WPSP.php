<?php

namespace WPSP;

use WPSP\App\Widen\Exceptions\Handler as ExceptionsHandler;
use WPSP\App\Widen\Translation\WPTranslation;
use WPSP\App\Widen\Updater\Updater;
use WPSP\App\Widen\View\Share;

class WPSP extends \WPSPCORE\WPSP {

	/** @var null|WPSP|\WPSPCORE\WPSP */
	public static $instance = null;

	/*
	 *
	 */

	/**
	 * @return WPSP|\WPSPCORE\WPSP|null
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

	public static function start($handleRequest = true) {
		$WPSP = static::instance();
		$WPSP->setApplication(__DIR__, $handleRequest);
		if (function_exists('add_action')) {
			add_action('init', function() { static::aferSetupApplication(); });
		}
		return $WPSP;
	}

	public static function startConsole() {
		$WPSP = static::instance();
		$WPSP->setApplicationForConsole(__DIR__);
		if (function_exists('add_action')) {
			add_action('init', function() { static::aferSetupApplicationForConsole(); });
		}
		return $WPSP;
	}

	/*
	 *
	 */

	public static function aferSetupApplication() {
		Updater::instance()->init();
		WPTranslation::instance()->init();
		static::shareVariablesForAllViews();
		static::overrideExceptionHandler();
	}

	public static function aferSetupApplicationForConsole() {
		if (defined('WPSP_ACTIVE')) {
			Updater::instance()->init();
			WPTranslation::instance()->init();
			static::shareVariablesForAllViews();
			static::overrideExceptionHandler();
		}
	}

	/*
	 *
	 */

	public static function shareVariablesForAllViews() {
		$share = Share::instance();
		$share->share();
		$share->compose();
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