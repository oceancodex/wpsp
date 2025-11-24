<?php

namespace WPSP\App\Traits;

use WPSP\Funcs;

trait StartSessionTrait {

	public function startSession(): void {

		/** @var \Illuminate\Http\Request $request */
		$request = Funcs::app('request');
		/** @var \Illuminate\Session\SessionManager $session */
		$session = Funcs::app('session');

		$sessionCookieName = Funcs::config('session.cookie'); // ví dụ: wpsp-session
		$clientSessionId   = $request->cookie($sessionCookieName);

		// 🔥 1. Kiểm tra cookie remember: wpsp_remember_****
		$rememberCookies = array_filter($_COOKIE, function ($key) {
			return str_starts_with($key, 'wpsp_remember_');
		}, ARRAY_FILTER_USE_KEY);

		$hasRememberCookie = !empty($rememberCookies);

		// 🔥 2. Nếu có session cookie -> dùng nó
		if ($clientSessionId) {
			$session->setId($clientSessionId);
		}
		else {
			// 🔥 3. Ngược lại: tạo session cookie như bình thường
			$cookie = cookie(
				$session->getName(),
				$session->getId(),
				Funcs::config('session.lifetime'),
				'/',
				null,
				true,
				true,
				false,
				Funcs::config('session.same_site')
			);

			header('Set-Cookie: ' . $cookie, false);
		}

		if (!$session->isStarted()) {
			$session->start();
		}

		// 🔥 5. Nếu có remember cookie -> KHÔNG tạo lại session cookie
		if ($hasRememberCookie) {
			return; // ⛔ DỪNG TẠI ĐÂY -> không gửi Set-Cookie session nữa
		}
	}
}
