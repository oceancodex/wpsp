<?php

namespace WPSP\app\Http\Middleware;

use WP_REST_Request;
use Symfony\Component\HttpFoundation\Request;
use WPSP\app\Extras\Instances\Auth\Auth;
use WPSPCORE\Base\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware {

    public function handle(Request|WP_REST_Request $request): bool {
        return Auth::check();
    }

}