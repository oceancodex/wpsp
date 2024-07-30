<?php

namespace WPSP\app\Http\Controllers;

use WPSP\app\Extend\Instances\Cache\RateLimiter;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class ApiController extends BaseController {

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

}