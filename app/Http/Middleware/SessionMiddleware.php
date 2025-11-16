<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\Funcs;

class SessionMiddleware {

	public function handle(Request $request, Closure $next): Response {
		$this->generateSession();
		return $next($request);
	}

	/**
	 * Gửi cookie session về cho trình duyệt
	 */


	public function generateSession() {
		$request = Funcs::app('request');
		$session = Funcs::app('session');
		$clientCookie = $request->cookie(Funcs::config('session.cookie'));

		if ($clientCookie) {
			$session->setId($clientCookie);
		}

		$session->start();

		$cookie = cookie(
			$session->getName(),
			$session->getId(),
			Funcs::config('session.lifetime'),
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
