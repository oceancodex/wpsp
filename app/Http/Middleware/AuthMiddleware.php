<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\App\Instances\Auth\Auth;
use WPSP\Funcs;

class AuthMiddleware {

	public function __construct() {
		/** @var Session $session */
		$session = Funcs::app('session');
		$session->start();
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
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
