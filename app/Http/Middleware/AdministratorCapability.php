<?php

namespace WPSP\app\Http\Middleware;

use WPSPCORE\Base\BaseMiddleware;

class AdministratorCapability extends BaseMiddleware {

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request) {
		return true;
	}

}