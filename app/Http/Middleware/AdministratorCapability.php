<?php

namespace WPSP\App\Http\Middleware;

use WPSPCORE\Http\Middleware\BaseMiddleware;

class AdministratorCapability extends BaseMiddleware {

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request) {
		return current_user_can('administrator');
	}

}