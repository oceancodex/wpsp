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
			$instance         = new static(__DIR__, __NAMESPACE__, Funcs::PREFIX_ENV, []);
			$instance->funcs  = Funcs::instance();
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

		if (Funcs::config('app.debug')) {
			static::overrideExceptionHandler();
		}

		if (function_exists('add_action')) {
			add_action('init', function() {
				static::aferSetupApplication();
			});
		}

		return $WPSP;
	}

	public static function startConsole() {
		$WPSP = static::instance();
		$WPSP->setApplicationForConsole(__DIR__);

//		if (Funcs::config('app.debug')) {
//			static::overrideExceptionHandler();
//		}

		if (function_exists('add_action')) {
			add_action('init', function() {
				static::aferSetupApplicationForConsole();
			});
		}

		return $WPSP;
	}

	/*
	 *
	 */

//	public function afterSetPaths() {}

//	public function afterBoostrap() {}

//	public function afterBoostrapConsole() {}

//	public function afterBindings() {}

//	public function afterBindingsConsole() {}

	/*
	 *
	 */

	public function beforeHandleRequest() {
		static::$instance->middlewares = require(Funcs::getBootstrapPath('/middlewares.php'));
	}

//	public function applyMiddlewares() {}

//	public function beforeResponse() {}

//	public function afterHandleRequest() {}

	/*
	 *
	 */

	public static function aferSetupApplication() {
		Updater::instance()->init();
		WPTranslation::instance()->init();
		static::shareVariablesForAllViews();
	}

	public static function aferSetupApplicationForConsole() {
		if (defined('WPSP_ACTIVE')) {
			Updater::instance()->init();
			WPTranslation::instance()->init();
			static::shareVariablesForAllViews();
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
		static $registered = false;
		if ($registered) return;
		$registered = true;

		// 1. Chuyển đổi các PHP Warnings / Errors thành ErrorException một cách an toàn
		set_error_handler(function($severity, $message, $file, $line) {
			// Nếu lỗi bị ẩn đi bởi toán tử @ thì bỏ qua
			if (!(error_reporting() & $severity)) {
				return false;
			}

			// Chuẩn hóa dấu gạch chéo
			$normalizedFile = str_replace('\\', '/', $file);

			// DEPRECATION: chỉ log, không throw (giống Laravel gốc)
			if ($severity === E_DEPRECATED || $severity === E_USER_DEPRECATED) {
				static::logDeprecation($message, $normalizedFile, $line);
				return true; // đã xử lý, PHP không in ra nữa
			}

			// BỎ QUA các lỗi từ view đã compile hoặc vendor/laravel
			if (
				str_contains($normalizedFile, 'storage/framework/views') ||
				str_contains($normalizedFile, 'vendor/laravel')
			) {
				return false;
			}

			throw new \ErrorException($message, 0, $severity, $file, $line);
		});

		// 2. Bộ bắt Exception an toàn có cơ chế chống lặp đệ quy (Anti-recursion lock)
		set_exception_handler(function(\Throwable $e) {
			static $isRenderingError = false;

			// Nếu đang trong quá trình render lỗi trước đó mà lại phát sinh thêm lỗi mới (như lỗi Array to string conversion)
			if ($isRenderingError) {
				// Fallback khẩn cấp ra trình duyệt bằng wp_die đơn giản, không render view phức tạp nữa
				wp_die(
					'<h1>Fatal Error (Recursion Blocked)</h1>' .
					'<p>' . esc_html($e->getMessage()) . ' in ' . esc_html($e->getFile()) . ':' . $e->getLine() . '</p>',
					'Fatal Error',
					['response' => 500]
				);
			}

			$isRenderingError = true;

			// LẤY FOLDER PATH CỦA EXCEPTION TẠI ĐÂY:
//			$exceptionFile   = str_replace('\\', '/', $e->getFile());
//			$exceptionFolder = dirname($exceptionFile);
//			$pluginDirName   = Funcs::getPluginDirNameFromPath($exceptionFolder);

			if (Funcs::isDebugBarValid() && $debugbar = Funcs::debugBar()) {
				$debugbar?->addThrowable($e);
				$debugbar?->addMessage($e->getMessage(), 'error', $e->getTrace());
			}

			try {
				$app     = Funcs::app();
				$handler = ($app !== null)
					? $app->make(ExceptionsHandler::class)
					: new ExceptionsHandler();
			}
			catch (\Throwable $ex) {
				$handler = new ExceptionsHandler();
			}

			$handler->report($e);
			$handler->render($e);

			$isRenderingError = false;
		});
	}

	protected static function logDeprecation($message, $file, $line) {
		try {
			$app = Funcs::app();
			if (!$app || !$app->bound('log')) return;

			$channel = Funcs::config('logging.deprecations.channel', 'null');
			if (!$channel || $channel === 'null') return;

			$app->make('log')->channel($channel)->warning(
				sprintf('%s in %s on line %s', $message, $file, $line)
			);
		}
		catch (\Throwable $e) {
			// Logger chưa sẵn sàng hoặc lỗi cấu hình: bỏ qua, không để deprecation làm hỏng request
		}
	}

}