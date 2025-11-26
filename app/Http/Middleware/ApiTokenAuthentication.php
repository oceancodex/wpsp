<?php

namespace WPSP\App\Http\Middleware;

use WPSP\App\Models\UsersModel;
use WPSP\App\Traits\InstancesTrait;
use WPSP\Funcs;

class ApiTokenAuthentication {

	use InstancesTrait;

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request): bool {
		$token = Funcs::instance()->_getBearerToken();
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