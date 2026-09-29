<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Cookie\CookieValuePrefix;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;

class PreventRequestForgeryWithoutOrigin extends PreventRequestForgery {

	private $args = [];

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure                 $next
	 *
	 * @return mixed
	 *
	 * @throws \Illuminate\Session\TokenMismatchException
	 * @throws \Illuminate\Http\Exceptions\OriginMismatchException
	 */
	public function handle($request, Closure $next, $args = []): Response {
		$this->args = $args;

		if (
			$this->isReading($request) ||
			$this->runningUnitTests() ||
			$this->inExceptArray($request) ||
			$this->tokensMatch($request)
		) {
			return tap($next($request), function($response) use ($request) {
				if ($this->shouldAddXsrfTokenCookie()) {
					$this->addCookieToResponse($request, $response);
				}
			});
		}

		throw new TokenMismatchException('CSRF token mismatch.');
	}

	/**
	 * Get the CSRF token from the request.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return string|null
	 */
	protected function getTokenFromRequest($request) {

		// Với các route original thì sẽ xử lý như Laravel thông thường.
		if (!isset($this->args['route'])) {
			return parent::getTokenFromRequest($request);
		}

		// Với các route WPSP thì sẽ xử lý với cookie prefix độc lập.
		$cookieName = $this->args['route']->funcs->_config('session.cookie');
		$token      = $request->input('_token') ?: $request->header($cookieName . '-X-CSRF-TOKEN');

		if (!$token && $header = $request->header($cookieName . '-X-XSRF-TOKEN')) {
			try {
				$token = CookieValuePrefix::remove($this->encrypter->decrypt($header, static::serialized()));
			}
			catch (DecryptException) {
				$token = '';
			}
		}

		return $token;
	}

}
