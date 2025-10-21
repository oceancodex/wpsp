<?php

namespace WPSP\app\Exceptions;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseException;

class InvalidDataException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (422: Unprocessable Entity)
	 */
	public $statusCode = 422;

	/**
	 * Tùy chỉnh cách render Exception.
	 * Laravel tự động gọi hàm này khi không có try/catch.
	 */
	public function render() {
		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'message' => $this->getMessage(),
			], $this->statusCode);
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Sử dụng view.
		return Funcs::view('errors.default', [
			'message' => $this->getMessage(),
		]);

		// Sử dụng redirect.
//		return wp_redirect('https://google.com');

		// Sử dụng wp_die.
//		wp_die(
//			'<h1>Lỗi ' . $this->statusCode . '</h1><p>' . $this->getMessage() . '</p>',
//			'InvalidDataException',
//			[
//				'response' => $this->statusCode,
//				'back_link' => true,
//			]
//		);
	}

}