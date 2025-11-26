<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdministratorCapability {

	public function handle(Request $request, Closure $next, $args = []): bool {
		return current_user_can('administrator');
	}

}