<?php

namespace WPSP\routes;

use WPSP\app\Http\Middleware\ApiTokenAuthentication;
use WPSP\app\Http\Middleware\SanctumMiddleware;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ApisRouteTrait;
use WPSP\Funcs;
use WPSP\app\Http\Controllers\ApisController;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\ApiAuthentication;

class Apis extends BaseRoute {

	use ApisRouteTrait;

	/*
	 *
	 */

	public function apis() {
		$this->post('get-api-token', [ApisController::class, 'getApiToken'], true);
		$this->post('test-api-token', [ApisController::class, 'testApiToken'], true, null, [[ApiTokenAuthentication::class, 'handle']]);

		$this->post('login-nonce', [ApisController::class, 'wpRestNonce'], true);
		$this->post('login', [ApisController::class, 'login'], true);
		$this->post('test-keep-login', [ApisController::class, 'testKeepLogin'], true);
		$this->post('logout', [ApisController::class, 'logout'], true);

		$this->post('sanctum-generate-access-token', [ApisController::class, 'sanctumGenerateAccessToken'], true);
		$this->post('sanctum-read-posts', [ApisController::class, 'testSanctumReadPosts'], true, null, [[SanctumMiddleware::class, 'handle']]);
		$this->post('sanctum-refresh-token', [ApisController::class, 'sanctumRefreshAccessToken'], true);
		$this->post('sanctum-revoke-token', [ApisController::class, 'sanctumRevokeAccessToken'], true, null, [[SanctumMiddleware::class, 'handle']]);

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

	public function filters() {
//		$this->filter('rest_index', function(\WP_REST_Response $response) {
//			$response->data = null;
//			return $response;
//		}, false, null, null, 10, 1);
	}

}