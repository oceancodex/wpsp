<?php

namespace WPSP\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use WPSP\App\Models\UsersModel;
use WPSP\Funcs;

class ApiTokenAuthentication {

	public function handle(Request $request, Closure $next, $args = []) {
		$token = Funcs::getBearerToken();
		if (!$token) {
			return false;
		}

		$tokenHash = hash('sha256', $token);
		if (!UsersModel::where('api_token', $tokenHash)->first()) {
			return false;
		}

		return true;
	}

}