<?php

namespace WPSP\app\Http\Middleware;

use WPSPCORE\Base\BaseMiddleware;

class ApiTokenAuthentication extends BaseMiddleware {

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request) {
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