<?php

namespace WPSP\routes;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use WPSP\App\Http\Middleware\ApiTokenAuthentication;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\SanctumMiddleware;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\ApisRouteTrait;
use WPSP\Funcs;
use WPSP\App\Http\Controllers\ApisController;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\BearerMiddleware;

class Apis extends BaseRouter {

	use InstancesTrait, ApisRouteTrait;

	/*
	 *
	 */

	public function apis() {
		$this->name('api-token.')->prefix('api-token')->group(function() {
			$this->post('get', [ApisController::class, 'getApiToken'], true)->name('get');
			$this->middleware(ApiTokenAuthentication::class)->post('test', [ApisController::class, 'testApiToken'], true)->name('test');
		});

		$this->name('auth.')->group(function() {
			$this->post('login-nonce', [ApisController::class, 'wpRestNonce'])->name('nonce');
			$this->middleware(AuthenticationMiddleware::class)->group(function() {
				$this->post('test-keep-login', [ApisController::class, 'testKeepLogin'])->name('test-keep-login');
			});
			$this->post('login', [ApisController::class, 'login'], true)->name('login');
			$this->post('logout', [ApisController::class, 'logout'], true)->name('logout');
		});

		$this->name('users.')->group(function() {
			$this->middleware(AuthenticationMiddleware::class)->group(function() {
				$this->post('users/(?P<id>\d+)/update', [ApisController::class, 'usersUpdate'], true)->name('update');
			});
		});

//		$this->prefix('sanctum')->name('sanctum.')->group(function() {
//			$this->post('generate-access-token', [ApisController::class, 'sanctumGenerateAccessToken'], true)->name('generate');
//			$this->middleware([
//				[SanctumMiddleware::class, 'abilities:create:posts,edit:posts']
//			])->post('test-read-posts', [ApisController::class, 'testSanctumReadPosts'], true)->name('test-read-posts');
//			$this->post('refresh-token', [ApisController::class, 'sanctumRefreshAccessToken'], true)->name('refresh');
//			$this->post('revoke-token', [ApisController::class, 'sanctumRevokeAccessToken'], true)->name('revoke');
//		});

//		$this->prefix('validation')->name('validation.')->group(function() {
//			$this->post('test-params-direct', [ApisController::class, 'validationParamsDirectTest'], true)->name('test-params-direct');
//			$this->post('test-params-form-request', [ApisController::class, 'validationParamsFormRequestTest'], true)->name('test-params-form-request');;
//		});

//		$this->get('test-rate-limit', [ApisController::class, 'wpsp'], true)->name('test-rate-limit');
	}

	/*
	 *
	 */

	public function customProperties() {
		$this->defaultNamespace = $this->funcs->_config('app.short_name');
		$this->defaultVersion   = 'v1';
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