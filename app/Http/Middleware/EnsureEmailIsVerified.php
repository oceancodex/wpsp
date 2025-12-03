<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use WPSP\Funcs;

class EnsureEmailIsVerified {

	/**
	 * Handle an incoming request.
	 */
	public function handle($request, Closure $next, $args = []) {
		$requestPath = trim($request->getRequestUri(), '/\\');

		/**
		 * Kiểm tra đơn giản xem request hiện tại có khớp với path đã được đăng ký trong route hay không.
		 * Các route sẽ luôn được đăng ký vào hoạt động.
		 * Ví dụ với AdminPages thì route sẽ luôn được đăng ký.
		 * Nếu không kiểm tra path thì sẽ luôn bị redirect về trang login với bất cứ request nào.
		 */
		if (preg_match('/' . Funcs::instance()->_regexPath($args['route']->fullPath) . '$/iu', $requestPath)) {
			if (!$request->user() ||
				($request->user() instanceof MustVerifyEmail &&
					!$request->user()->hasVerifiedEmail())) {

				if ($request->expectsJson()) {
					wp_send_json(Funcs::response(false, null, 'Your email address is not verified.'), 403);
				}
				else {
					Redirect::to(Funcs::route('RewriteFrontPages', 'verification.notice'))->send();
					exit;
				}
			}
		}

		return $next($request);
	}

}
