<?php

namespace WPSP\app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, Closure $next): Response {
		if (!isset($_GET['token'])) {
			// Trả về redirect response thật
			return new Response('TestMiddleware false', 403);
		}
		return $next($request);
	}

}
