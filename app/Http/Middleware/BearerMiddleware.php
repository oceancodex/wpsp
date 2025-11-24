<?php

namespace WPSP\App\Http\Middleware;

use WPSPCORE\Base\BaseMiddleware;

class BearerMiddleware extends BaseMiddleware {

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request) {
		if (method_exists($request, 'get_header')) {
			return $request->get_header('Authorization') == 'Bearer 123456789';
		}
		elseif (method_exists($request, 'get_headers')) {
			return $request->get_headers()['Authorization'] == 'Bearer 123456789';
		}
		return false;
	}

}