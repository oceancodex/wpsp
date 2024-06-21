<?php

namespace WPSP\app\Http\Middleware;

use WPSPCORE\Base\BaseMiddleware;
use Symfony\Component\HttpFoundation\Request;
use WP_REST_Request;

class ApiAuthentication extends BaseMiddleware {
	public function handle(Request|WP_REST_Request $request): bool {
		if (method_exists($request, 'get_header')) {
			return $request->get_header('Authorization') == 'Bearer 123456789';
		}
		elseif (method_exists($request, 'get_headers')) {
			return $request->get_headers()['Authorization'] == 'Bearer 123456789';
		}
		return false;
	}
}