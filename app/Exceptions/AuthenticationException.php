<?php

namespace WPSP\app\Exceptions;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseException;

class AuthenticationException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (401: Unauthorized)
	 */
	public $statusCode = 401;

	/**
	 * Guards mà authentication đã thất bại
	 *
	 * @var array
	 */
	protected $guards = [];

	/**
	 * URL redirect (nếu cần)
	 *
	 * @var string|null
	 */
	protected $redirectTo = null;

	/**
	 * Khởi tạo exception
	 *
	 * @param string      $message    Thông điệp lỗi
	 * @param array       $guards     Guards đã thất bại
	 * @param string|null $redirectTo URL redirect
	 */
	public function __construct($message = 'Unauthenticated.', $guards = [], $redirectTo = null) {
		parent::__construct($message);

		$this->guards     = $guards;
		$this->redirectTo = $redirectTo;
	}

	/**
	 * Lấy danh sách guards
	 */
	public function guards() {
		return $this->guards;
	}

	/**
	 * Lấy URL redirect
	 */
	public function redirectTo() {
		return $this->redirectTo;
	}

	/**
	 * Tùy chỉnh cách render Exception.
	 */
	public function render() {
		status_header($this->statusCode);

		$message = $this->getMessage();

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (Funcs::wantsJson()) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'errors'  => [
					[
						'type'   => 'AuthenticationException',
						'guards' => $this->guards,
					]
				],
				'message' => $message,
			], 401);
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Redirect.
		if ($this->redirectTo) {
			wp_redirect($this->redirectTo);
			exit;
		}

		// Sử dụng view.
		try {
			echo Funcs::view('errors.401', [
				'message' => $message,
			]);
			exit;
		}
		catch (\Throwable $viewException) {}

		// Sử dụng wp_die.
		wp_die(
			'<h1>ERROR: 401 - Chưa xác thực</h1><p>' . $message . '</p>',
			'ERROR: 401 - Chưa xác thực',
			[
				'response'  => 401,
				'back_link' => true,
			]
		);
	}

	/**
	 * Ghi log lỗi (nếu cần)
	 */
	public function report() {
		if (Funcs::env('APP_DEBUG', true) == 'true') {
			error_log(sprintf(
				'AuthenticationException: %s | Guards: %s | URL: %s | IP: %s',
				$this->getMessage(),
				implode(', ', $this->guards),
				$_SERVER['REQUEST_URI'] ?? 'Unknown',
				$_SERVER['REMOTE_ADDR'] ?? 'Unknown'
			));
		}
	}

}