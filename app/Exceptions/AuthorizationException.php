<?php

namespace WPSP\App\Exceptions;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\App\Exceptions\BaseException;

/**
 * Exception cho phép truy cập bị từ chối.
 * Class này sử dụng để tự động xử lý function authorize() trong form request.
 */
class AuthorizationException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (403: Forbidden)
	 */
	public $statusCode = 403;

	/**
	 * Tùy chỉnh cách render Exception.
	 */
	public function render() {
		/**
		 * Với request AJAX hoặc REST API.
		 */
		if (Funcs::wantsJson()) {
			wp_send_json([
				'success' => false,
				'data'    => null,
				'errors'  => [
					[
						'type' => 'AuthorizationException',
					]
				],
				'message' => $this->getMessage(),
			], $this->statusCode);
			exit;
		}

		/**
		 * Với request thông thường.
		 */
		try {
			echo Funcs::view('errors.403', [
				'message' => $this->getMessage(),
			]);
			exit;
		}
		catch (\Throwable $e) {
		}

		wp_die(
			'<h1>ERROR: 403 - Truy cập bị từ chối</h1><p>' . $this->getMessage() . '</p>',
			'ERROR: 403 - Truy cập bị từ chối',
			[
				'response'  => $this->statusCode,
				'back_link' => true,
			]
		);
	}

}


