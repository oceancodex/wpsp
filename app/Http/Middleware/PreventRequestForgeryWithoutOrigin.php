<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;

class PreventRequestForgeryWithoutOrigin extends PreventRequestForgery {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 *
	 * @throws \Illuminate\Session\TokenMismatchException
	 * @throws \Illuminate\Http\Exceptions\OriginMismatchException
	 */
	public function handle($request, Closure $next): Response {
		if (
			$this->isReading($request) ||
			$this->runningUnitTests() ||
			$this->inExceptArray($request) ||
			$this->tokensMatch($request)
		) {
			return tap($next($request), function ($response) use ($request) {
				if ($this->shouldAddXsrfTokenCookie()) {
					$this->addCookieToResponse($request, $response);
				}
			});
		}

		throw new TokenMismatchException('CSRF token mismatch.');
	}

}
