<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Extras\Instances\Sanctum\Sanctum;
use WPSPCORE\Base\BaseMiddleware;

class SanctumMiddleware extends BaseMiddleware {

	public function handle($request): bool {
		try {
//			$sanctum = wpsp_auth('sanctum');
//			$user = $sanctum->user();
//			echo '<pre>'; print_r($user); echo '</pre>'; die();
			return wpsp_auth('sanctum')->user()->tokenCan('read:posts');
//			return Sanctum::instance()->user()->tokenCan('read:posts');
		}
		catch (\Exception|\Throwable $e) {
			return false;
		}
		
	}

}