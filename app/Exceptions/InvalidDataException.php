<?php

namespace WPSP\app\Exceptions;

use WPSP\app\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseException;

/**
 * Exception xử lý khi dữ liệu input không hợp lệ.
 */
class InvalidDataException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (422: Unprocessable Entity)
	 */
	public $code = 422;

	/**
	 * Tùy chỉnh cách render Exception.
	 * Tự động được gọi khi không có try/catch.
	 */
	public function render() {
		/** @var \Illuminate\Validation\ValidationException $e */
		$e = $this->getPrevious();
		if ($e) {
			$errors = $e->validator->errors()->all();
			$errorList = '<ul>';
			foreach ($errors as $error) {
				$errorList .= '<li>' . esc_html($error) . '</li>';
			}
			$errorList .= '</ul>';
		}

		$this->message = $errorList ?? null;

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'message' => $this->getMessage(),
			], $this->code);
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Sử dụng view.
		status_header($this->code);
		echo Funcs::view('errors.default', [
			'message' => $this->getMessage(),
			'code'    => $this->code,
			'status'  => 'Dữ liệu không hợp lệ',
		]);

		exit;

		// Sử dụng redirect.
//		return wp_redirect('https://google.com');

		// Sử dụng wp_die.
//		wp_die(
//			'<h1>Lỗi ' . $this->statusCode . '</h1><p>' . $this->getMessage() . '</p>',
//			'InvalidDataException',
//			[
//				'response' => $this->statusCode,
//				'back_link' => true
//			]
//		);
	}

}