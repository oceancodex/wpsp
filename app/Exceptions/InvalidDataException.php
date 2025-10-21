<?php

namespace WPSP\app\Exceptions;

use Exception;

class InvalidDataException extends Exception {

	/**
	 * Mã HTTP status code (422: Unprocessable Entity)
	 */
	public $statusCode = 422;

	/**
	 * Tùy chỉnh cách render Exception.
	 * Laravel tự động gọi hàm này khi không có try/catch.
	 */
//	public function render() {
//		// Kiểm tra xem có phải request AJAX/API không
//		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
//			wp_send_json([
//				'success' => false,
//				'message' => $this->getMessage(),
//				'code' => $this->statusCode
//			], $this->statusCode);
//			exit;
//		}
//
//		// Với request thông thường, hiển thị HTML
//		echo '<pre style="background:white;z-index:9999;position:relative">';
//		echo 'InvalidDataException: ' . $this->getMessage();
//		echo '</pre>';
//		exit;
//	}

}