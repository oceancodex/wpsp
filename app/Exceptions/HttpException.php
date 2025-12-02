<?php

namespace WPSP\App\Exceptions;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Exceptions\BaseException;

class HttpException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (mặc định 500)
	 */
	public $statusCode = 500;

	/**
	 * Headers bổ sung
	 *
	 * @var array
	 */
	protected $headers = [];

	/**
	 * Khởi tạo exception
	 *
	 * @param int         $statusCode HTTP status code
	 * @param string|null $message    Thông điệp lỗi
	 * @param array       $headers    Headers bổ sung
	 * @param int         $code       Exception code
	 */
	public function __construct($statusCode, $message = null, $headers = [], $code = 0) {
		$this->statusCode = $statusCode;
		$this->headers    = $headers;

		// Nếu không có message, tạo message mặc định từ status code
		$message = $message ?? $this->getDefaultMessageForStatusCode($statusCode);

		parent::__construct($message, $code);
	}

	/**
	 * Lấy status code
	 */
	public function getStatusCode() {
		return $this->statusCode;
	}

	/**
	 * Lấy headers
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * Set headers
	 */
	public function setHeaders($headers) {
		$this->headers = $headers;
		return $this;
	}

	/**
	 * Tùy chỉnh cách render Exception
	 */
	public function render() {
		status_header($this->statusCode);

		$message = $this->getMessage();

		// Set headers bổ sung.
		foreach ($this->headers as $key => $value) {
			if (!headers_sent()) {
				header("{$key}: {$value}");
			}
		}

		/**
		 * Với request AJAX hoặc REST API.
		 */

		if (Funcs::wantsJson()) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'errors'  => [
					[
						'type' => 'HttpException',
					],
				],
				'message' => $message,
			], $this->statusCode);
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Sử dụng view.
		try {
			$viewName     = "errors.{$this->statusCode}";
			$viewInstance = Funcs::instance()->_viewInstance();

			if ($viewInstance->exists($viewName)) {
				echo Funcs::view($viewName, [
					'message' => $this->getMessage(),
					'code'    => $this->statusCode,
					'status'  => $this->getDefaultMessageForStatusCode($this->statusCode),
				]);
				exit;
			}

			// Fallback: kiểm tra view default
			if ($viewInstance->exists('errors.default')) {
				echo Funcs::view('errors.default', [
					'message' => $this->getMessage(),
					'code'    => $this->statusCode,
					'status'  => $this->getDefaultMessageForStatusCode($this->statusCode),
				]);
				exit;
			}
		}
		catch (\Throwable $viewException) {
		}

		// Fallback cuối cùng: sử dụng wp_die()
		wp_die(
			'<h1>ERROR: ' . $this->statusCode . ' - Lỗi HTTP</h1><p>' . $message . '</p>',
			'ERROR: ' . $this->statusCode . ' - Lỗi HTTP',
			[
				'response'  => $this->statusCode,
				'back_link' => true,
			]
		);
	}

	/**
	 * Ghi log lỗi
	 */
	public function report() {
		if (Funcs::env('APP_DEBUG', true) == 'true') {
			error_log(sprintf(
				'HttpException [%d]: %s | URL: %s | IP: %s',
				$this->statusCode,
				$this->getMessage(),
				$_SERVER['REQUEST_URI'] ?? 'Unknown',
				$_SERVER['REMOTE_ADDR'] ?? 'Unknown'
			));
		}
	}

}