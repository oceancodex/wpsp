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
	public $statusCode = 422;

	/**
	 * Tùy chỉnh cách render Exception.
	 * Tự động được gọi khi không có try/catch.
	 */
	public function render() {
		status_header($this->statusCode);

		/** @var \Illuminate\Validation\ValidationException $e */
		$e = $this->getPrevious();
		if ($e) {
			$errors    = $e->validator->errors()->all();
			$errorList = '<ul>';
			foreach ($errors as $error) {
				$errorList .= '<li>' . esc_html($error) . '</li>';
			}
			$errorList .= '</ul>';
		}

		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (Funcs::wantsJson()) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'errors'  => $errors ?? '',
				'message' => $this->getMessage(),
			], $this->statusCode);
			exit;
		}

		/**
		 * Với request thông thường.
		 */

		// Sử dụng view.
		echo Funcs::view('errors.default', [
			'message'      => 'Vui lòng kiểm tra lại dữ liệu theo thông tin bên dưới:',
			'code'         => $this->statusCode,
			'errorMessage' => $errorList ?? '',
			'status'       => 'Dữ liệu không hợp lệ',
		]);
		exit;

		// Sử dụng redirect.
//		return wp_redirect(home_url());

		// Sử dụng wp_die.
//		wp_die(
//			'<h1>ERROR: 422 - Dữ liệu không hợp lệ</h1><p>' . $this->getMessage() . '</p>',
//			'ERROR: 422 - Dữ liệu không hợp lệ',
//			[
//				'response' => $this->statusCode,
//				'back_link' => true
//			]
//		);
	}

}