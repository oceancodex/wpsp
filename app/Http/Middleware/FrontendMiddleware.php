<?php

namespace WPSP\App\Http\Middleware;

use WPSPCORE\Base\BaseMiddleware;

class FrontendMiddleware extends BaseMiddleware {

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
	public function handle($request) {
		return !is_admin();
	}

}
