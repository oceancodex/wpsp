<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\App\Instances\Auth\Auth;
use WPSP\Funcs;

class AuthMiddleware {

	public function handle(Request $request, Closure $next): Response {
		if (!Auth::check()) {
			$this->generateSession();
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

	public function generateSession() {
		$request = Funcs::app('request');
		$session = Funcs::app('session');
		$clientCookie = $request->cookie('wpsp-session');

		if ($clientCookie) {
			$session->setId($clientCookie);
		}

		$session->start();

		$cookie = cookie(
			$session->getName(),
			$session->getId(),
			config('session.lifetime', 1),
			'/',
			null,
			true,
			true,
			false,
			'Lax'
		);

		header('Set-Cookie: ' . (string)$cookie, false);
	}

}
