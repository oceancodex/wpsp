<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontendMiddleware {

	public function handle(Request $request, Closure $next, $args = []): bool {
		return !is_admin();
	}

}
