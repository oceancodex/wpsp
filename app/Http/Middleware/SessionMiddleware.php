<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Symfony\Component\HttpFoundation\Response;

class SessionMiddleware {

	/**
	 * @var \Illuminate\Session\SessionManager
	 */
	protected $sessionManager;

	public function __construct(SessionManager $sessionManager) {
		$this->sessionManager = $sessionManager;
	}

	public function handle(Request $request, Closure $next): Response {
		// 1. Lấy session driver (file/database/redis...)
		$session = $this->sessionManager->driver();

		// 2. Lấy session ID có trong cookie request (nếu có)
		$sessionId = $request->cookies->get($session->getName());

		if ($sessionId) {
			$session->setId($sessionId);
		}

		// 3. Start session
		if (!$session->isStarted()) {
			$session->start();
		}

		// 4. Attach session vào Request
		$request->setLaravelSession($session);

		// 5. Chạy middleware tiếp theo
		/** @var Response $response */
		$response = $next($request);

		// 6. Save session để lưu data vào storage
		$session->save();

		// 7. Gửi cookie session về client
		$this->addSessionCookieToResponse($response, $session);

		return $response;
	}

	/**
	 * Gửi cookie session về cho trình duyệt
	 */
	protected function addSessionCookieToResponse(Response $response, $session): void {
		$lifetime = config('session.lifetime', 120); // 120 phút
		$cookie = cookie(
			$session->getName(),
			$session->getId(),
			$lifetime,          // <--- Fix: MUST SET!
			'/',
			null,
			false,
			true,
			false,
			'Lax'
		);
		$response->headers->setCookie($cookie);
		$response->sendHeaders();
	}

}
