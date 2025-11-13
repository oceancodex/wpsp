<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\App\Instances\Auth\Auth;

class AuthMiddleware {

	public function handle(Request $request, Closure $next): Response {
		if (!Auth::check()) {
			if ($request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => __('Bạn phải đăng nhập để tiếp tục', false, 'wpsp'),
				], 401);
			}
			return new Response('TestMiddleware false', 403);
		}

		return $next($request);
	}

}
