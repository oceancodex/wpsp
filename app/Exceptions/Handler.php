<?php

namespace WPSP\app\Exceptions;

use Illuminate\Validation\ValidationException;
use Throwable;

class Handler {

	public $dontReport = [
		//
	];

	public $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * @var callable|null Ignition's original exception handler
	 */
	protected $ignitionHandler = null;

	public function __construct($ignitionHandler = null) {
		$this->ignitionHandler = $ignitionHandler;
	}

	public function register() {
		//
	}

	public function render(\Throwable $e) {
		// Kiểm tra xem exception có method render() không
		if (method_exists($e, 'render')) {
			try {
				$result = $e->render();

				// Nếu render() trả về giá trị hoặc đã echo, return
				if ($result !== null) {
					echo $result;
					exit;
				}

				// Nếu render() đã echo và exit, code sẽ không chạy đến đây
				return;
			} catch (\Throwable $renderException) {
				// Nếu render() gặp lỗi, fallback sang Ignition
				$this->fallbackToIgnition($e);
			}
		}

		// ValidationException -> JSON hoặc redirect
		if ($e instanceof ValidationException) {
			$this->convertValidationExceptionToResponse($e);
			exit;
		}

		// Các exception khác -> sử dụng Ignition
		$this->fallbackToIgnition($e);
	}

	/**
	 * Fallback to Ignition handler
	 */
	protected function fallbackToIgnition(\Throwable $e) {
		if ($this->ignitionHandler && is_callable($this->ignitionHandler)) {
			call_user_func($this->ignitionHandler, $e);
		} else {
			// Nếu không có Ignition handler, hiển thị lỗi đơn giản
			$this->prepareResponse($e);
		}
	}

	public function report(Throwable $e) {
		if ($this->shouldntReport($e)) {
			return;
		}

		if (method_exists($e, 'report')) {
			return $e->report();
		}

		if (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG) {
			error_log(sprintf(
				'[%s] %s in %s:%s',
				get_class($e),
				$e->getMessage(),
				$e->getFile(),
				$e->getLine()
			));
		}
	}

	public function shouldReport(Throwable $e) {
		return !$this->shouldntReport($e);
	}

	public function shouldntReport(Throwable $e) {
		foreach ($this->dontReport as $type) {
			if ($e instanceof $type) {
				return true;
			}
		}

		return false;
	}

	public function invalidJson(ValidationException $e) {
		wp_send_json([
			'message' => $e->getMessage(),
			'errors'  => $e->validator->errors()->messages(),
		], 422);
		exit;
	}

	public function shouldReturnJson() {
		return wp_doing_ajax() ||
			(defined('REST_REQUEST') && REST_REQUEST) ||
			(!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
	}

	public function prepareResponse(Throwable $e) {
		if ($this->shouldReturnJson()) {
			$this->prepareJsonResponse($e);
			exit;
		}

		$this->redirectBack(['error' => 'exception']);
		exit;
	}

	public function prepareJsonResponse(Throwable $e) {
		$data = ['message' => $e->getMessage()];

		if (defined('WP_DEBUG') && WP_DEBUG) {
			$data['exception'] = get_class($e);
			$data['file']      = $e->getFile();
			$data['line']      = $e->getLine();
			$data['trace']     = $e->getTrace();
		}

		wp_send_json($data, 500);
		exit;
	}

	public function redirectBack(array $params = []) {
		$redirectUrl = wp_get_raw_referer() ?: admin_url();

		foreach ($params as $key => $value) {
			$redirectUrl = add_query_arg($key, $value, $redirectUrl);
		}

		wp_safe_redirect($redirectUrl);
		exit;
	}

	public function convertValidationExceptionToResponse(ValidationException $e) {
		if ($this->shouldReturnJson()) {
			$this->invalidJson($e);
			exit;
		}

		$this->redirectBack(['error' => 'validation']);
		exit;
	}

}