<?php

namespace OCBP\app\Http\Middleware;

use OCBPCORE\Base\BaseMiddleware;
use Symfony\Component\HttpFoundation\Request;
use WP_REST_Request;

class EditorCapability extends BaseMiddleware {
	public function handle(Request|WP_REST_Request $request): bool {
		return current_user_can('editor');
	}
}
