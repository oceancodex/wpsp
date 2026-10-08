<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use WPSPCORE\App\Http\Request;

class EditorCapability {

	public function handle(Request $request, Closure $next, $args = []) {
		return current_user_can('read');
	}

}
