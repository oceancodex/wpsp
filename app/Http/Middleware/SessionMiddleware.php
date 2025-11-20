<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\App\Traits\StartSessionTrait;

class SessionMiddleware {

	use StartSessionTrait;

	public function handle(Request $request, Closure $next): Response {
		$this->startSession();
		return $next($request);
	}

}
