<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BearerMiddleware {

	public function handle(Request $request, Closure $next, $args = []): bool {
		if (method_exists($request, 'get_header')) {
			return $request->get_header('Authorization') == 'Bearer 123456789';
		}
		elseif (method_exists($request, 'get_headers')) {
			return $request->get_headers()['Authorization'] == 'Bearer 123456789';
		}
		return false;
	}

}