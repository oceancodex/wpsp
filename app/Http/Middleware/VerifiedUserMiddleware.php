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
	public function handle(Request $request, Closure $next, $args = []): Response {
		$requestPath = trim($request->getRequestUri(), '/\\');
		/**
		 * Kiểm tra xem request hiện tại có khớp với path đã được đăng ký trong route hay không.\
		 * Các route sẽ luôn được đăng ký và hoạt động.\
		 * Ví dụ với AdminPages thì route sẽ luôn được đăng ký.\
		 * Nếu không kiểm tra path thì sẽ luôn bị redirect về trang login với bất cứ request nào.
		 */
		if (preg_match('/^' . Funcs::instance()->_regexPath($args['route']->path) . '$/iu', $requestPath)) {
			if (!$request->user()?->hasVerifiedEmail()) {
				$verificationUrl = Funcs::route('RewriteFrontPages', 'verification.resend', true);
				$response = new Response('Tài khoản của bạn chưa xác thực! Vui lòng xác thực tài khoản <a href="'.$verificationUrl.'">tại đây</a>.', 403);
				$response->send();
				die();
			}
		}

		return $next($request);
	}

}
