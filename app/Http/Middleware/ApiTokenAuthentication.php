<?php

namespace WPSP\App\Http\Middleware;

use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;
use WPSPCORE\Base\BaseMiddleware;

class ApiTokenAuthentication extends BaseMiddleware {

	use InstancesTrait;

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

		if (!Funcs::auth('api')->check()) {
			return false;
		}

		return true;
	}

}