<?php

namespace WPSP\app\Exceptions;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseException;

/**
 * Exception cho phép truy cập bị từ chối.
 * Class này sử dụng để tự động xử lý function authorize() trong form request.
 */
class AuthorizationException extends BaseException {

	use InstancesTrait;

	/**
	 * Mã HTTP status code (403: Forbidden)
	 */
	public $code = 403;

	/**
	 * Tùy chỉnh cách render Exception.
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
			], $this->code);
			exit;
		}

		/**
		 * Với request thông thường.
		 */
		wp_die(
			'<h1>ERROR: 403 - Không có quyền truy cập</h1><p>' . $this->getMessage() . '</p>',
			'ERROR: 403 - Không có quyền truy cập',
			[
				'response'  => $this->code,
				'back_link' => true,
			]
		);
	}

}