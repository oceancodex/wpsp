<?php

namespace WPSP\app\Http\Controllers;

use Illuminate\Support\Str;
use WPSP\app\Extras\Instances\Cache\RateLimiter;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class ApisController extends BaseController {

	public function wpsp(\WP_REST_Request $request): array {

		// Rate limit for 10 requests per 30 seconds based on the user display name or request IP address.
		try {
			$rateLimitKey           = 'api_wpsp_' . (wp_get_current_user()->display_name ?? $this->request->getClientIp());
			$rateLimitByIp          = RateLimiter::get('api', $rateLimitKey)->consume();
			$rateLimitByIpRemaining = $rateLimitByIp->getRemainingTokens();
			$rateLimitByIpAccepted  = $rateLimitByIp->isAccepted();
		}
		catch (\Exception|\Throwable $e) {
			$rateLimitByIpAccepted  = true;
			$rateLimitByIpRemaining = null;
		}

		if (false === $rateLimitByIpAccepted) {
			return Funcs::response(false, ['rate_limit_remaining' => $rateLimitByIpRemaining], 'Rate limit exceeded. Please try again later.', 429);
		}

		return Funcs::response(true, ['rate_limit_remaining' => $rateLimitByIpRemaining], 'This is a new API end point!', 200);

	}

	/*
	 *
	 */

	public function getApiToken(\WP_REST_Request $request) {
		$login    = sanitize_text_field($request->get_param('login'));
		$password = $request->get_param('password');

		if (!$login || !$password) {
			wp_send_json(['success' => false, 'message' => 'Missing credentials'], 422);
		}

		$user = wpsp_auth('api')->user();

		if (!$user && !wpsp_auth('api')->attempt(['login' => $login, 'password' => $password])) {
			wp_send_json(['success' => false, 'message' => 'Invalid credentials'], 401);
		}

		$apiToken = $user->getAttribute('api_token');
		if (!$apiToken) {
			$apiToken = Str::random('32');
			$user->setAttribute('api_token', $apiToken);
			$user->setAttribute('last_login_at', current_time('mysql'));
			$user->setAttribute('last_login_ip', $_SERVER['REMOTE_ADDR'] ?? null);
			$user->save();
		}

		wp_send_json([
			'success'   => true,
			'api_token' => $apiToken,
			'user'      => [
				'id'       => $user->id,
				'name'     => $user->name,
				'username' => $user->username,
				'email'    => $user->email,
				'roles'    => $user->roles()->pluck('name')->all(),
			],
		], 200);
	}

}