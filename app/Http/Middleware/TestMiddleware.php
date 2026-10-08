<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware {

	public function handle(Request $request, Closure $next) {
		if (!isset($_GET['token'])) {
			return new Response('TestMiddleware false', 403);
		}
		return $next($request);
	}

}
