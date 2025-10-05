<?php

namespace wpsp\app\Http\Middleware;

use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseMiddleware;
use Symfony\Component\HttpFoundation\Request;
use WP_REST_Request;

class SanctumMiddleware extends BaseMiddleware {

	use InstancesTrait;

	public function handle(Request|WP_REST_Request $request): bool {
		$sanctum = \WPSPCORE\Sanctum\Sanctum::getInstance();

		// Kiểm tra xem đã authenticated chưa (bất kể token hay session)
		if (!$sanctum->check()) {
			return false;
		}

		return true;
	}

}
