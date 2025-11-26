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
			$requestPath = trim($request->getRequestUri(), '/\\');
			/**
			 * Kiểm tra đơn giản xem request hiện tại có khớp với path đã được đăng ký trong route hay không.
			 * Các route sẽ luôn được đăng ký vào hoạt động.
			 * Ví dụ với AdminPages thì route sẽ luôn được đăng ký.
			 * Nếu không kiểm tra path thì sẽ luôn bị redirect về trang login với bất cứ request nào.
			 */
			if (preg_match('/' . Funcs::instance()->_escapeRegex($args['path']) . '$/iu', $requestPath)) {
				$allMiddlewares = $args['middlewares'] ?? [];
				$relation       = $args['middlewares']['relation'] ?? 'and';
				$relation       = strtolower($relation);

				/**
				 * Nếu relation là "OR" thì chỉ redirect khi middleware này là middleware cuối cùng trong middleware group.
				 * Vì "OR" là điều kiện "hoặc", nếu middleware này không phải là middleware cuối cùng thì sẽ redirect trước khi các middleware khác được thực thi.
				 */
				if ($relation == 'or') {
					$isLastMiddleware = Funcs::isLastMiddleware(static::class, $allMiddlewares);
					if ($isLastMiddleware) {
						if ($request->wantsJson()) {
							wp_send_json(Funcs::response(false, null, 'Authentication false'), 403);
						}
						else {
							wp_redirect(Funcs::route('RewriteFrontPages', 'auth.login', true));
						}
						return new Response('Authentication false', 403);
					}
				}

				/**
				 * Nếu relation là "AND" thì sẽ redirect ngay khi middleware này được thực thi.
				 */
				else {
					if ($request->wantsJson()) {
						wp_send_json(Funcs::response(false, null, 'Authentication false'), 403);
					}
					else {
						wp_redirect(Funcs::route('RewriteFrontPages', 'auth.login', true));
					}
					return new Response('Authentication false', 403);
				}
			}
		}

		return $next($request);
	}

}
