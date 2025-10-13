<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Extras\Instances\Auth\Auth;
use WPSPCORE\Base\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware {

	/**
	 * @param \Symfony\Component\HttpFoundation\Request|\WP_REST_Request $request
	 *
	 * @return bool
	 */
    public function handle($request) {
        return Auth::check();
    }

}