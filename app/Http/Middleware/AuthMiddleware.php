<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\App\Instances\Auth\Auth;
use WPSP\App\Traits\StartSessionTrait;
use WPSP\Funcs;

class AuthMiddleware {

	use StartSessionTrait;

	public function handle(Request $request, Closure $next, $args = []): Response {
		if (!Auth::check()) {

			// Start session.
			$this->startSession();

			if ($request->wantsJson()) {
				return response()->json([
					'success' => false,
					'message' => __('Bạn phải đăng nhập để tiếp tục', false, 'wpsp'),
				], 401);
			}

			$requestPath = trim($request->getRequestUri(), '/\\');
			if (preg_match('/' . Funcs::instance()->_escapeRegex($args['path']) . '$/iu', $requestPath)) {
				wp_redirect(Funcs::route('RewriteFrontPages', 'auth.login', true));
				return new Response();
			}
			else {
				return new Response('TestMiddleware false', 403);
			}
		}

		return $next($request);
	}

}
