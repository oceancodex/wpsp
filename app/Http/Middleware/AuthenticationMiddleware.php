<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WPSP\App\Instances\Auth\Auth;
use WPSP\Funcs;

class AuthenticationMiddleware {

	public function handle(Request $request, Closure $next, $args = []) {
		if (!Auth::check()) {
			if ($request->wantsJson()) {
				wp_send_json(Funcs::response(false, null, 'Authentication false'), 403);
			}
			else {
				$requestPath = trim($request->getRequestUri(), '/\\');
				if (preg_match('/' . Funcs::instance()->_escapeRegex($args['path']) . '$/iu', $requestPath)) {
					$allMiddlewares = $args['all_middlewares'] ?? [];
					$relation = $args['all_middlewares']['relation'] ?? 'and';
					$relation = strtolower($relation);
					$isLastMiddleware = Funcs::isLastMiddleware(static::class, $allMiddlewares);
					if ($relation == 'or') {
						if ($isLastMiddleware) {
							wp_redirect(Funcs::route('RewriteFrontPages', 'auth.login', true));
						}
					}
					else {
						wp_redirect(Funcs::route('RewriteFrontPages', 'auth.login', true));
					}
				}
				else {
					return new Response('Authentication false', 403);
				}
			}
		}

		return $next($request);
	}

}
