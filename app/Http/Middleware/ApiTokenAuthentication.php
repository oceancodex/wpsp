<?php

namespace WPSP\app\Http\Middleware;

use WP_REST_Request;
use Symfony\Component\HttpFoundation\Request;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;

class ApiTokenAuthentication extends BaseMiddleware {

	use InstancesTrait;

	public function handle(Request|WP_REST_Request $request): bool {
		$token = $request->get_header('Authorization');
		if (!$token) {
			return false;
		}

		// Lấy guard api từ wpsp-auth
		$auth = wpsp_auth('api');
		if (!$auth) {
			return false;
		}

		// Tìm user theo token qua provider của guard api
		$provider = $auth->getProvider(); // SessionsGuard từ wpsp-auth có provider
		if (!method_exists($provider, 'retrieveByApiToken')) {
			// Nếu provider chưa có method này, bạn cần bổ sung (xem ghi chú bên dưới)
			return false;
		}

		$user = $provider->retrieveByApiToken($token);
		if (!$user) {
			return false;
		}

		// Đăng nhập tạm thời vào guard api (không qua session)
		if (method_exists($auth, 'setUser')) {
			$auth->setUser($user);
		}

		return true;
	}

}