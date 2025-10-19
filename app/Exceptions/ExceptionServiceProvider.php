<?php

namespace WPSP\app\Exceptions;

class ExceptionServiceProvider {

	/**
	 * Register exception handler hooks
	 *
	 * @return void
	 */
	public static function boot() {
		// Handle WordPress fatal errors
		add_action('wp_fatal_error_handler_enabled', '__return_false');

		// Register custom error handler
		set_error_handler([static::class, 'handleError']);

		// Register custom exception handler
		set_exception_handler([static::class, 'handleException']);
	}

	/**
	 * Handle PHP errors
	 *
	 * @param int $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param int $errline
	 * @return bool
	 */
	public static function handleError($errno, $errstr, $errfile, $errline) {
		if (!(error_reporting() & $errno)) {
			return false;
		}

		// Convert error to exception
		throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
	}

	/**
	 * Handle uncaught exceptions
	 *
	 * @param \Throwable $e
	 * @return void
	 */
	public static function handleException(\Throwable $e) {
		$handler = new Handler();
		$handler->report($e);
		$handler->render($e);
	}

}