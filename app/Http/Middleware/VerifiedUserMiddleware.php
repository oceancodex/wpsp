<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\Funcs;

class VerifiedUserMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
	 */
	public function handle(Request $request, Closure $next): Response {
		if (!$request->user()->hasVerifiedEmail()) {
			$verificationUrl = Funcs::route('RewriteFrontPages', 'verification.resend', true);
			$response = new Response('Tài khoản của bạn chưa xác thực! Vui lòng xác thực tài khoản <a href="'.$verificationUrl.'">tại đây</a>.', 403);
			$response->send();
			die();
		}

		return $next($request);
	}

}
