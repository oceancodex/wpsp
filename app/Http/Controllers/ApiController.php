<?php

namespace WPSP\app\Http\Controllers;

use WPSP\app\Extend\Instances\Cache\RateLimiter;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class ApiController extends BaseController {

	public function wpsp(\WP_REST_Request $request): array {

		// Rate limit for 10 requests per 30 seconds based on the user display name or request IP address.
		$rateLimitKey = 'api_wpsp_'. (wp_get_current_user()->display_name ?? $this->request->getClientIp());
		$rateLimitByIp = RateLimiter::get('api', $rateLimitKey)->consume()->isAccepted();

		if (false === $rateLimitByIp) {
			return Funcs::response(false, null, 'Rate limit exceeded. Please try again later.', 429);
		}

		return Funcs::response(true, null, 'This is a new API end point!', 200);

	}

}