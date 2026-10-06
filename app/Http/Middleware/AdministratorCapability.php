<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use WPSP\App\Widen\Support\Facades\Request;

class AdministratorCapability {

	public function handle(Request $request, Closure $next, $args = []) {
		return current_user_can('administrator');
	}

}