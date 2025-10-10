<?php

namespace WPSP\app\Http\Middleware;

use WP_REST_Request;
use Symfony\Component\HttpFoundation\Request;
use WPSPCORE\Base\BaseMiddleware;

class ApiTokenAuthentication extends BaseMiddleware {

	public function handle(Request|WP_REST_Request $request): bool {
		$token = $this->funcs->_getBearerToken();
		if (!$token) {
			return false;
		}

		if (!wpsp_auth('api')->check()) {
			return false;
		}

		return true;
	}

}