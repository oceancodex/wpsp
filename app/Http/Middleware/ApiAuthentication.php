<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Extras\Instances\Auth\Auth;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;
use Symfony\Component\HttpFoundation\Request;
use WP_REST_Request;

class ApiAuthentication extends BaseMiddleware {

	use InstancesTrait;

//	public function handle(Request|WP_REST_Request $request): bool {
//		if (method_exists($request, 'get_header')) {
//			return $request->get_header('Authorization') == 'Bearer 123456789';
//		}
//		elseif (method_exists($request, 'get_headers')) {
//			return $request->get_headers()['Authorization'] == 'Bearer 123456789';
//		}
//		return false;
//	}

	public function handle(\Illuminate\Http\Request|WP_REST_Request $request): bool {
		$token = $this->getBearerToken($request);
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

	private function getBearerToken($request): ?string {
		$authHeader = null;

		if (method_exists($request, 'get_header')) {
			$authHeader = $request->get_header('Authorization');
		}
		elseif (method_exists($request, 'header')) {
			$authHeader = $request->header('Authorization');
		}
		elseif (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
			$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
		}

		if (!$authHeader || !is_string($authHeader)) {
			return null;
		}

		if (preg_match('/Bearer\s+(.+)$/i', $authHeader, $m)) {
			return trim($m[1]);
		}

		return null;
	}

}