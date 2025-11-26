<?php

namespace WPSP\routes;

use WPSP\App\Http\Controllers\ApisController;
use WPSP\App\Http\Middleware\ApiTokenAuthentication;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\SanctumMiddleware;
use WPSPCORE\Routes\Apis\ApisRouteTrait;
use WPSP\App\Instances\Routes\Apis as Route;

class Apis {

	use ApisRouteTrait;

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function apis() {
		Route::name('api-token.')->prefix('api-token')->group(function() {
			Route::post('get/(?P<id>\d+)$', [ApisController::class, 'getApiToken'])->name('get');
//			Route::middleware(ApiTokenAuthentication::class)->post('test', [ApisController::class, 'testApiToken'])->name('test');
		});

//		Route::name('auth.')->group(function() {
//			Route::post('login-nonce', [ApisController::class, 'wpRestNonce'])->name('nonce');
//			Route::middleware(AuthenticationMiddleware::class)->group(function() {
//				Route::post('test-keep-login', [ApisController::class, 'testKeepLogin'])->name('test-keep-login');
//			});
//			Route::post('login', [ApisController::class, 'login'], true)->name('login');
//			Route::post('logout', [ApisController::class, 'logout'], true)->name('logout');
//		});
//
//		Route::name('users.')->group(function() {
//			Route::middleware(AuthenticationMiddleware::class)->group(function() {
//				Route::post('users/(?P<id>\d+)/update', [ApisController::class, 'usersUpdate'], true)->name('update');
//			});
//		});
//
//		Route::prefix('sanctum')->name('sanctum.')->group(function() {
//			Route::post('generate-access-token', [ApisController::class, 'sanctumGenerateAccessToken'], true)->name('generate');
//			Route::middleware([
//				[SanctumMiddleware::class, 'abilities:create:posts,edit:posts']
//			])->post('test-read-posts', [ApisController::class, 'testSanctumReadPosts'], true)->name('test-read-posts');
//			Route::post('refresh-token', [ApisController::class, 'sanctumRefreshAccessToken'], true)->name('refresh');
//			Route::post('revoke-token', [ApisController::class, 'sanctumRevokeAccessToken'], true)->name('revoke');
//		});
//
//		Route::prefix('validation')->name('validation.')->group(function() {
//			Route::post('test-params-direct', [ApisController::class, 'validationParamsDirectTest'], true)->name('test-params-direct');
//			Route::post('test-params-form-request', [ApisController::class, 'validationParamsFormRequestTest'], true)->name('test-params-form-request');;
//		});
//
//		Route::get('test-rate-limit', [ApisController::class, 'wpsp'], true)->name('test-rate-limit');
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {
//		Route::filter('rest_index', function(\WP_REST_Response $response) {
//			$response->data = null;
//			return $response;
//		}, false, null, null, 10, 1);
	}

}