<?php

namespace WPSP\routes;

use WPSP\App\Http\Controllers\ApisController;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Http\Middleware\ApiTokenAuthentication;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\SanctumMiddleware;
use WPSPCORE\Routes\Apis\ApisRouteTrait;
use WPSP\App\Instances\Routes\Apis as Route;

class Apis {

	use ApisRouteTrait;

	public function apis() {
		Route::namespace('wpsp')->version('v1')->group(function() {
			Route::name('api-token.')->prefix('api-token')->group(function() {
				Route::get('get', [ApisController::class, 'getApiToken'])->name('get');
				Route::middleware(['relation' => 'AND', ApiTokenAuthentication::class, AuthenticationMiddleware::class])->post('test', [ApisController::class, 'testApiToken'])->name('test');
			});
			Route::name('auth.')->prefix('auth')->group(function() {
				Route::post('login-nonce', [ApisController::class, 'wpRestNonce'])->name('nonce');
				Route::middleware([[AuthenticationMiddleware::class, 'handle']])->group(function() {
					Route::post('test-keep-login', [ApisController::class, 'testKeepLogin'])->name('test-keep-login');
				});
				Route::post('login', [ApisController::class, 'login'])->name('login');
				Route::post('logout', [ApisController::class, 'logout'])->name('logout');
			});
			Route::name('users.')->prefix('users')->group(function() {
				Route::middleware(AuthenticationMiddleware::class)->group(function() {
//					Route::post('(?P<id>\w+)/update', [ApisController::class, 'usersUpdate'])->name('update');
					Route::get('{id}/update', [ApisController::class, 'usersUpdate'])->name('update');
				});
			});
			Route::prefix('sanctum')->name('sanctum.')->group(function() {
				Route::post('generate-access-token', [ApisController::class, 'sanctumGenerateAccessToken'])->middleware(AuthenticationMiddleware::class)->name('generate');
				Route::post('test-read-posts', [ApisController::class, 'testSanctumReadPosts'])->middleware([
					[SanctumMiddleware::class, 'abilities:create:posts,edit:posts'],
				])->name('test-read-posts');
				Route::post('refresh-token', [ApisController::class, 'sanctumRefreshAccessToken'])->name('refresh');
				Route::post('revoke-token', [ApisController::class, 'sanctumRevokeAccessToken'])->name('revoke');
			});
			Route::prefix('validation')->name('validation.')->group(function() {
				Route::post('test-params-direct', [ApisController::class, 'validationParamsDirectTest'])->name('test-params-direct');
				Route::post('test-params-form-request', [ApisController::class, 'validationParamsFormRequestTest'])->name('test-params-form-request');;
			});
			Route::get('test-rate-limit', [ApisController::class, 'wpsp'])->name('test-rate-limit');
		});
	}

	public function actions() {
//		Route::action('admin_init', function() { echo 'Hello world!'; })->middleware(AdministratorCapability::class)->name('action_init');
	}

	public function filters() {
		/**
		 * Xóa hết các Rest API khỏi /wp-json.
		 * Khi truy cập /wp-json sẽ không hiển thị ra bất cứ Rest API nào cả.
		 * Tuy nhiên các Rest API đã đăng ký vẫn sẽ hoạt động.
		 */
//		Route::filter('rest_index', function(\WP_REST_Response $response) {
//			$response->data = null;
//			return $response;
//		}, 10, 1);

		/**
		 * Đổi prefix "wp-json" mặc định của Rest API thành "api".
		 */
//		Route::filter('rest_url_prefix', function($prefix) {
//			return 'api';
//		}, 10, 1);
	}

}