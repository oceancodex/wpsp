<?php

namespace WPSP\routes;

use WPSP\app\Http\Middleware\ApiTokenAuthentication;
use WPSP\app\Http\Middleware\SanctumMiddleware;
use WPSP\app\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRoute;
use WPSPCORE\Traits\ApisRouteTrait;
use WPSP\Funcs;
use WPSP\app\Http\Controllers\ApisController;
use WPSP\app\Http\Middleware\EditorCapability;
use WPSP\app\Http\Middleware\ApiAuthentication;

class Apis extends BaseRoute {

	use InstancesTrait, ApisRouteTrait;

	/*
	 *
	 */

	public function apis() {
		$this->prefix('v1')->name('v1.')->group(function() {
			$this->prefix('auth')->name('auth.')->group(function() {
				$this->post('login', [ApisController::class, 'login'])
					->name('login');

				$this->post('logout', [ApisController::class, 'logout'])
					->name('logout');
			});

			$this->prefix('users')->name('users.')->middleware([ApiTokenAuthentication::class])->group(function() {
				$this->post('(?P<id>\d+)/update', [ApisController::class, 'usersUpdate'])
					->name('update');
			});
		});

		$this->prefix('sanctum')->name('sanctum.')->group(function() {
			$this->post('generate-token', [ApisController::class, 'sanctumGenerateAccessToken'])
				->name('generate-token');

			$this->post('read-posts', [ApisController::class, 'testSanctumReadPosts'])
				->name('read-posts')
				->middleware([SanctumMiddleware::class]);
		});


		$this->post('get-api-token', [ApisController::class, 'getApiToken'], true);
		$this->post('test-api-token', [ApisController::class, 'testApiToken'], true, null, [[ApiTokenAuthentication::class, 'handle']]);

		$this->post('login-nonce', [ApisController::class, 'wpRestNonce'], true);
		$this->post('login', [ApisController::class, 'login'], true);
		$this->post('test-keep-login', [ApisController::class, 'testKeepLogin'], true);
		$this->post('logout', [ApisController::class, 'logout'], true);

		$this->post('users/(?P<id>\d+)/update', [ApisController::class, 'usersUpdate'], true);

		$this->post('sanctum-generate-access-token', [ApisController::class, 'sanctumGenerateAccessToken'], true);
		$this->post('sanctum-read-posts', [ApisController::class, 'testSanctumReadPosts'], true, null, [[SanctumMiddleware::class, 'handle']]);
		$this->post('sanctum-refresh-token', [ApisController::class, 'sanctumRefreshAccessToken'], true);
		$this->post('sanctum-revoke-token', [ApisController::class, 'sanctumRevokeAccessToken'], true, null, [[SanctumMiddleware::class, 'handle']]);

		$this->post('validation-params-direct-test', [ApisController::class, 'validationParamsDirectTest'], true);
		$this->post('validation-params-form-request-test', [ApisController::class, 'validationParamsFormRequestTest'], true);

		$this->get('test-rate-limit', [ApisController::class, 'wpsp'], true);

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