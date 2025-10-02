<?php

namespace WPSP\app\Http\Middleware;

use WP_REST_Request;
use Symfony\Component\HttpFoundation\Request;
use WPSP\app\Models\UsersModel;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;

class ApiTokenAuthentication extends BaseMiddleware {

	use InstancesTrait;

	public function handle(Request|WP_REST_Request $request): bool {
		$authHeader = $request->get_header('Authorization');
		if (!preg_match('/^Bearer\s+(.+)$/i', $authHeader, $m)) {
			return false;
		}

		$token = trim($m[1] ?? '');
		if (!$token) {
			return false;
		}

		$user = UsersModel::query()
			->where('api_token', $token)
			->first();

		if (!$user) {
			return false;
		}

		return true;
	}

}