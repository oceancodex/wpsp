<?php

namespace WPSP\app\Http\Controllers;

use WPSPCORE\Base\BaseController;
use WPSPCORE\Objects\Cache\Cache;
use Symfony\Contracts\Cache\ItemInterface;

class ApiController extends BaseController {

	public function wpsp(\WP_REST_Request $request): array {
		$users = Cache::get('users', function(ItemInterface $item) {
			$item->expiresAfter(3600); // Cache expiration in seconds
			return get_users([
				'fields'  => ['ID', 'user_login'],
				'orderby' => 'user_login',
			]);
		});
		return _response(true, $users, 'Get all users successfully!', 200);
	}

}