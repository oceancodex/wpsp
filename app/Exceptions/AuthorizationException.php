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
	public $statusCode = 403;

	/**
	 * Tùy chỉnh cách render Exception.
	 */
	public function render() {
		// Kiểm tra xem có phải request AJAX/API không
		if (wp_doing_ajax() || (defined('REST_REQUEST') && REST_REQUEST)) {
			status_header($this->statusCode);

			wp_send_json([
				'success' => false,
				'data'    => null,
				'message' => $this->getMessage(),
			]);
			exit;
		}

		// Với request thông thường, sử dụng wp_die()
		wp_die(
			'<h1>Không có quyền truy cập</h1><p>' . esc_html($this->getMessage()) . '</p>',
			'AuthorizationException',
			[
				'response'  => $this->statusCode,
				'back_link' => true,
			]
		);
	}

}