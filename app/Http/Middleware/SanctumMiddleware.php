<?php

namespace WPSP\app\Http\Middleware;

use WPSP\app\Extras\Instances\Sanctum\Sanctum;
use WPSPCORE\Base\BaseMiddleware;
use WPSP\app\Traits\InstancesTrait;

class SanctumMiddleware extends BaseMiddleware {

	use InstancesTrait;

	public function handle($request): bool {
		try {
			return wpsp_auth('sanctum')->user()->tokenCan('read:posts');
//			return Sanctum::instance()->user()->tokenCan('read:posts');
		}
		catch (\Exception|\Throwable $e) {
			return false;
		}
		
	}

}