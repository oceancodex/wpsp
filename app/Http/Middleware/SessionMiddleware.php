<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use WPSP\Funcs;

class SessionMiddleware {

	public function handle($request, Closure $next): Response {
		// Khởi động session
		try {
			$session = Funcs::app('session');
			if (!$session->isStarted()) {
				$session->start();
			}
		} catch (\Throwable $e) {
			// Ignore session errors
		}

		return $next($request);
	}

}
