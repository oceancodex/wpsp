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
		$this->prefix('wpsp/api-token')
			->name('wpsp.api-token.')
			->group(function() {
				$this->post('get-api-token', [ApisController::class, 'getApiToken'], true)->name('get');
				$this->middleware(ApiTokenAuthentication::class)->post('test-api-token', [ApisController::class, 'testApiToken'], true)->name('test');
			});

		$this->name('auth.')->group(function() {
			$this->namespace('wpsp')->version('v1')->post('login-nonce', [ApisController::class, 'wpRestNonce'], true)->name('nonce');
			$this->post('login', [ApisController::class, 'login'], true)->name('login');
			$this->post('test-keep-login', [ApisController::class, 'testKeepLogin'], true)->name('test-keep-login');
			$this->post('logout', [ApisController::class, 'logout'], true)->name('logout');
		});

		$this->name('users.')->group(function() {
			$this->post('users/(?P<id>\d+)/update', [ApisController::class, 'usersUpdate'], true)->name('update');
		});

		$this->name('sanctum.')->group(function() {
			$this->post('sanctum-generate-access-token', [ApisController::class, 'sanctumGenerateAccessToken'], true)->name('generate');
			$this->post('sanctum-read-posts', [ApisController::class, 'testSanctumReadPosts'], true, null, [[SanctumMiddleware::class, 'handle']])->name('read-posts');
			$this->post('sanctum-refresh-token', [ApisController::class, 'sanctumRefreshAccessToken'], true)->name('refresh');
			$this->post('sanctum-revoke-token', [ApisController::class, 'sanctumRevokeAccessToken'], true, null, [[SanctumMiddleware::class, 'handle']])->name('revoke');
		});

		$this->name('validation.')->group(function() {
			$this->post('validation-params-direct-test', [ApisController::class, 'validationParamsDirectTest'], true)->name('params-direct-test');
			$this->post('validation-params-form-request-test', [ApisController::class, 'validationParamsFormRequestTest'], true)->name('params-form-request-test');;
		});

		$this->get('test-rate-limit', [ApisController::class, 'wpsp'], true)->name('test-rate-limit');
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