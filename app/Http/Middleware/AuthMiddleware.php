<?php

namespace WPSP\App\Http\Middleware;

use WPSP\App\Workers\Auth\Auth;
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