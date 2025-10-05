<?php

namespace WPSP\routes;

use WPSP\app\Http\Middleware\ApiTokenAuthentication;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ApisRouteTrait;
use WPSP\Funcs;
use WPSP\app\Traits\InstancesTrait;
use WPSP\app\Http\Controllers\ApisController;
use WPSP\app\Http\Controllers\AuthController;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\ApiAuthentication;

class Apis extends BaseRoute {

	use ApisRouteTrait, InstancesTrait;

	/*
	 *
	 */

	public function apis(): void {
		$this->post('login', [AuthController::class, 'login'], true);
		$this->post('logout', [AuthController::class, 'logout'], true);
		$this->post('get-api-token', [ApisController::class, 'getApiToken'], true);
		$this->post('test-api-token', [ApisController::class, 'testApiToken'], true, null, [[ApiTokenAuthentication::class, 'handle']]);

		// Demo
		$this->get('wpsp', [ApisController::class, 'wpsp'], true, null, [
//			'relation' => 'OR',
//			[ApiAuthentication::class, 'handle'],
//			[EditorCapability::class, 'handle']
		], null, null);
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters(): void {
//		$this->hook('filter', 'rest_index', function(\WP_REST_Response $response) {
//			$response->data = null;
//			return $response;
//		}, false, null, null, 10, 1);
	}

}