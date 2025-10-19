<?php

namespace WPSP\app\Exceptions;

use Illuminate\Validation\ValidationException;
use WPSP\Funcs;
use Throwable;

class Handler {

	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<\Throwable>>
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Report or log an exception.
	 *
	 * @param  \Throwable  $e
	 * @return void
	 *
	 * @throws \Throwable
	 */
	public function report(Throwable $e) {
		if ($this->shouldntReport($e)) {
			return;
		}

		if (method_exists($e, 'report')) {
			return $e->report();
		}

		// Log to WordPress debug log
		if (WP_DEBUG_LOG) {
			error_log(sprintf(
				'[%s] %s in %s:%s',
				get_class($e),
				$e->getMessage(),
				$e->getFile(),
				$e->getLine()
			));
		}
	}

	/**
	 * Determine if the exception should be reported.
	 *
	 * @param  \Throwable  $e
	 * @return bool
	 */
	public function shouldReport(Throwable $e) {
		return !$this->shouldntReport($e);
	}

	/**
	 * Determine if the exception is in the "do not report" list.
	 *
	 * @param  \Throwable  $e
	 * @return bool
	 */
	protected function shouldntReport(Throwable $e) {
		foreach ($this->dontReport as $type) {
			if ($e instanceof $type) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Throwable  $e
	 * @return mixed
	 *
	 * @throws \Throwable
	 */
	public function render(Throwable $e) {
		if (method_exists($e, 'render')) {
			return $e->render();
		}

		if ($e instanceof ValidationException) {
			return $this->convertValidationExceptionToResponse($e);
		}

		return $this->prepareResponse($e);
	}

	/**
	 * Convert a validation exception into a response.
	 *
	 * @param  \Illuminate\Validation\ValidationException  $e
	 * @return void
	 */
	protected function convertValidationExceptionToResponse(ValidationException $e) {
		$errors = $e->validator->errors();

		// Store errors in transient for redirect
		set_transient(
			Funcs::config('app.short_name') . '_validation_errors',
			[
				'errors' => $errors->all(),
				'messages' => $errors->messages(),
			],
			30
		);

		if ($this->shouldReturnJson()) {
			return $this->invalidJson($e);
		}

		$this->redirectBack(['error' => 'validation']);
	}

	/**
	 * Prepare a response for the given exception.
	 *
	 * @param  \Throwable  $e
	 * @return void
	 */
	protected function prepareResponse(Throwable $e) {
		// Store exception details
		set_transient(
			Funcs::config('app.short_name') . '_exception_details',
			[
				'message' => $e->getMessage(),
				'exception' => get_class($e),
				'file' => $e->getFile(),
				'line' => $e->getLine(),
				'trace' => WP_DEBUG ? $e->getTraceAsString() : null,
			],
			30
		);

		if ($this->shouldReturnJson()) {
			return $this->prepareJsonResponse($e);
		}

		$this->redirectBack(['error' => 'exception']);
	}

	/**
	 * Determine if the request should return JSON.
	 *
	 * @return bool
	 */
	protected function shouldReturnJson() {
		return wp_doing_ajax() ||
			(defined('REST_REQUEST') && REST_REQUEST) ||
			(!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
	}

	/**
	 * Convert a validation exception into a JSON response.
	 *
	 * @param  \Illuminate\Validation\ValidationException  $e
	 * @return void
	 */
	protected function invalidJson(ValidationException $e) {
		wp_send_json([
			'message' => $e->getMessage(),
			'errors' => $e->validator->errors()->messages(),
		], 422);
	}

	/**
	 * Prepare a JSON response for the given exception.
	 *
	 * @param  \Throwable  $e
	 * @return void
	 */
	protected function prepareJsonResponse(Throwable $e) {
		$data = [
			'message' => $e->getMessage(),
		];

		if (WP_DEBUG) {
			$data['exception'] = get_class($e);
			$data['file'] = $e->getFile();
			$data['line'] = $e->getLine();
			$data['trace'] = $e->getTrace();
		}

		wp_send_json($data, 500);
	}

	/**
	 * Redirect back with query parameters.
	 *
	 * @param  array $params
	 *
	 * @return void
	 */
	public function redirectBack(array $params = []) {
		$redirectUrl = wp_get_raw_referer() ?: admin_url();

		foreach ($params as $key => $value) {
			$redirectUrl = add_query_arg($key, $value, $redirectUrl);
		}

		wp_safe_redirect($redirectUrl);
		exit;
	}

}