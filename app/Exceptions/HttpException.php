<?php

namespace WPSP\app\Exceptions;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseException;

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
	public function __construct(int $statusCode, ?string $message = null, array $headers = [], int $code = 0) {
		$this->statusCode = $statusCode;
		$this->headers    = $headers;

		// Nếu không có message, tạo message mặc định từ status code
		$message = $message ?? $this->getDefaultMessageForStatusCode($statusCode);

		parent::__construct($message, $code);
	}

	/**
	 * Lấy status code
	 */
	public function getStatusCode(): int {
		return $this->statusCode;
	}

	/**
	 * Lấy headers
	 */
	public function getHeaders(): array {
		return $this->headers;
	}

	/**
	 * Set headers
	 */
	public function setHeaders(array $headers): self {
		$this->headers = $headers;
		return $this;
	}

	/**
	 * Lấy message mặc định cho status code
	 */
	protected function getDefaultMessageForStatusCode(int $statusCode): string {
		$messages = [
			// 4xx Client Errors
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Payload Too Large',
			414 => 'URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Range Not Satisfiable',
			417 => 'Expectation Failed',
			418 => "I'm a teapot",
			421 => 'Misdirected Request',
			422 => 'Unprocessable Entity',
			423 => 'Locked',
			424 => 'Failed Dependency',
			425 => 'Too Early',
			426 => 'Upgrade Required',
			428 => 'Precondition Required',
			429 => 'Too Many Requests',
			431 => 'Request Header Fields Too Large',
			451 => 'Unavailable For Legal Reasons',

			// 5xx Server Errors
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			506 => 'Variant Also Negotiates',
			507 => 'Insufficient Storage',
			508 => 'Loop Detected',
			510 => 'Not Extended',
			511 => 'Network Authentication Required',
		];

		return $messages[$statusCode] ?? 'HTTP Error';
	}

	/**
	 * Tùy chỉnh cách render Exception
	 */
	public function render() {
		// Set headers bổ sung
		foreach ($this->headers as $key => $value) {
			if (!headers_sent()) {
				header("{$key}: {$value}");
			}
		}

		// Kiểm tra xem có phải request AJAX/API không
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			status_header($this->statusCode);

			wp_send_json([
				'success' => false,
				'message' => $this->getMessage(),
				'code'    => $this->statusCode,
			]);
			exit;
		}

		// Với request thông thường
		// Kiểm tra xem có view tùy chỉnh cho status code này không
		$viewName = "errors.{$this->statusCode}";

		try {
			$viewInstance = \WPSP\Funcs::instance()->_viewInstance();

			if ($viewInstance->exists($viewName)) {
				status_header($this->statusCode);
				echo \WPSP\Funcs::view($viewName, [
					'message'    => $this->getMessage(),
					'statusCode' => $this->statusCode,
				]);
				exit;
			}

			// Fallback: kiểm tra view default
			if ($viewInstance->exists('errors.default')) {
				status_header($this->statusCode);
				echo \WPSP\Funcs::view('errors.default', [
					'message'    => $this->getMessage(),
					'statusCode' => $this->statusCode,
				]);
				exit;
			}
		}
		catch (\Throwable $viewException) {
			// Nếu view bị lỗi, fallback
		}

		// Fallback cuối cùng: sử dụng wp_die()
		wp_die(
			'<h1>Lỗi ' . $this->statusCode . '</h1><p>' . esc_html($this->getMessage()) . '</p>',
			$this->statusCode . ' - ' . $this->getDefaultMessageForStatusCode($this->statusCode),
			[
				'response'  => $this->statusCode,
				'back_link' => true,
			]
		);
	}

	/**
	 * Ghi log lỗi
	 */
	public function report(): void {
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