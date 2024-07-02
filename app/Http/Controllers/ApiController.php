<?php

namespace WPSP\app\Http\Controllers;

use Symfony\Contracts\Cache\ItemInterface;
use WPSP\app\Extend\Instances\Cache\Cache;
use WPSP\Funcs;
use WPSPCORE\Base\BaseController;

class ApiController extends BaseController {

	public function wpsp(\WP_REST_Request $request): array {
		return Funcs::response(true, null, 'This is a new API end point!', 200);
	}

}