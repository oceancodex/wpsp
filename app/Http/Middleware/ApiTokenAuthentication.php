<?php

namespace WPSP\App\Http\Middleware;

use WPSP\App\Models\UsersModel;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;

class ApiTokenAuthentication extends BaseMiddleware {

	use InstancesTrait;

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request): bool {
		$token = $this->funcs->_getBearerToken();
		if (!$token) {
			return false;
		}

		$tokenHash = hash('sha256', $token);
		if (!UsersModel::where('api_token', $tokenHash)->first()) {
			return false;
		}

		return true;
	}

}