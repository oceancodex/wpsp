<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;
use Symfony\Component\HttpFoundation\Request;
use WP_REST_Request;

class SanctumMiddleware extends BaseMiddleware {

	use InstancesTrait;

	public function handle(Request|WP_REST_Request $request): bool {
		$sanctum = \WPSPCORE\Sanctum\Sanctum::getInstance();

		// Kiểm tra xem đã authenticated chưa (bất kể token hay session)
		if (!$sanctum->check()) {
			return false;
		}

		return true;
	}

	/**
	 * Chỉ cho phép token-based authentication
	 */
	public function tokenOnly() {
		$sanctum = \WPSPCORE\Sanctum\Sanctum::getInstance();

		if (!$sanctum->usingTokenGuard()) {
			return new \WP_Error(
				'token_required',
				'Endpoint này chỉ chấp nhận token authentication',
				['status' => 401]
			);
		}

		if (!$sanctum->check()) {
			return new \WP_Error(
				'unauthenticated',
				'Token không hợp lệ',
				['status' => 401]
			);
		}

		return true;
	}

	/**
	 * Chỉ cho phép session-based authentication
	 */
	public function sessionOnly() {
		$sanctum = \WPSPCORE\Sanctum\Sanctum::getInstance();

		if (!$sanctum->usingSessionGuard()) {
			return new \WP_Error(
				'session_required',
				'Endpoint này chỉ chấp nhận session authentication',
				['status' => 401]
			);
		}

		if (!$sanctum->check()) {
			return new \WP_Error(
				'unauthenticated',
				'Bạn cần đăng nhập',
				['status' => 401]
			);
		}

		return true;
	}

	/**
	 * Chấp nhận cả token và session
	 */
	public function anyAuth() {
		$sanctum = \WPSPCORE\Sanctum\Sanctum::getInstance();

		if (!$sanctum->check()) {
			return new \WP_Error(
				'unauthenticated',
				'Bạn cần đăng nhập',
				['status' => 401]
			);
		}

		return true;
	}

}
