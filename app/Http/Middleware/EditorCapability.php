<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EditorCapability {

	public function handle(Request $request, Closure $next, $args = []) {
		return current_user_can('read');
	}

}
