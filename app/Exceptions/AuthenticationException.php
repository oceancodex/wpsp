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
		// Kiểm tra xem có phải request AJAX/API không
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			status_header($this->statusCode);

			wp_send_json([
				'success' => false,
				'message' => $this->getMessage(),
				'code'    => $this->statusCode,
				'guards'  => $this->guards,
			]);
			exit;
		}

		// Với request thông thường
		// Nếu có redirectTo, redirect đến đó
		if ($this->redirectTo) {
			wp_redirect($this->redirectTo);
			exit;
		}

		// Nếu không, redirect về trang login
		$loginUrl = wp_login_url($_SERVER['REQUEST_URI'] ?? '');

		// Hoặc sử dụng wp_die() nếu muốn hiển thị message
		wp_die(
			'<h1>Chưa xác thực</h1><p>' . esc_html($this->getMessage()) . '</p><p><a href="' . esc_url($loginUrl) . '">Đăng nhập</a></p>',
			'AuthenticationException',
			[
				'response'  => $this->statusCode,
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