<?php

namespace WPSP\routes;

use WPSP\App\Extends\Routes\RewriteFrontPages\RewriteFrontPages as Route;
use WPSP\App\Extends\Traits\InstancesTrait;
use WPSP\App\Http\Middleware\AuthenticationMiddleware;
use WPSP\App\Http\Middleware\EnsureEmailIsVerified;
use WPSP\App\WordPress\RewriteFrontPages\auth;
use WPSP\App\WordPress\RewriteFrontPages\wpsp;
use WPSP\App\WordPress\RewriteFrontPages\wpsp_with_template;
use WPSPCORE\App\Routes\RewriteFrontPages\RewriteFrontPagesRouteTrait;

class RewriteFrontPages {

	use InstancesTrait, RewriteFrontPagesRouteTrait;

	/*
	 *
	 */

	public function rewrite_front_pages() {
		Route::name('auth.')->prefix('auth')->group(function() {
			Route::get('login', [auth::class, 'login'])->name('login');
			Route::get('register', [auth::class, 'register'])->name('register');
		});
		Route::name('verification.')->group(function() {
			Route::get('/email/verify', [auth::class, 'notice'])->name('notice');
			Route::get('/email/verify/{id}/{hash}', [auth::class, 'verify'])->middleware(AuthenticationMiddleware::class)->name('verify');
			Route::post('/email/verification-notification', [auth::class, 'send'])->middleware(AuthenticationMiddleware:: class)->name('send');
		});
		Route::name('wpsp.')->group(function() {
			Route::get('wpsp\/(?P<endpoint>[^\/]+)$', [wpsp::class, 'index'])->middleware(EnsureEmailIsVerified::class)->name('index');
			Route::post('wpsp\/(?P<endpoint>[^\/]+)$', [wpsp::class, 'update']);
			Route::get('wpsp-with-template\/?$', [wpsp_with_template::class, 'index']);
		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}