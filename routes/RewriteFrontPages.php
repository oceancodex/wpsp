<?php

namespace WPSP\routes;

use WPSP\App\WP\RewriteFrontPages\auth;
use WPSP\App\WP\RewriteFrontPages\wpsp;
use WPSP\App\WP\RewriteFrontPages\wpsp_with_template;
use WPSPCORE\Routes\RewriteFrontPages\RewriteFrontPagesRouteTrait;

class RewriteFrontPages {

	use RewriteFrontPagesRouteTrait;

	/*
	 *
	 */

	public function rewrite_front_pages() {
		Route::name('auth.')->prefix('auth')->group(function() {
			Route::get('login', [auth::class, 'login'])->middleware(StartSessionMiddleware::class)->name('login');
		});
		Route::name('wpsp.')->group(function() {
			Route::get('wpsp\/(?P<endpoint>[^\/]+)\/?$', [wpsp::class, 'index'])->middleware(StartSessionMiddleware::class)->name('index');
			Route::post('wpsp\/([^\/]+)\/?$', [wpsp::class, 'update']);
			Route::get('wpsp-with-template\/?$', [wpsp_with_template::class, 'index']);
		});
	}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}