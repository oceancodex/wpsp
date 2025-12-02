<?php

namespace WPSP\routes;

use WPSP\App\Traits\InstancesTrait;
use WPSP\App\WordPress\RewriteFrontPages\auth;
use WPSP\App\WordPress\RewriteFrontPages\wpsp;
use WPSP\App\WordPress\RewriteFrontPages\wpsp_with_template;
use WPSP\App\Instances\Routes\RewriteFrontPages\RewriteFrontPages as Route;
use WPSPCORE\App\Routes\RewriteFrontPages\RewriteFrontPagesRouteTrait;

class RewriteFrontPages {

	use InstancesTrait, RewriteFrontPagesRouteTrait;

	/*
	 *
	 */

	public function rewrite_front_pages() {
		Route::name('auth.')->prefix('auth')->group(function() {
			Route::get('login', [auth::class, 'login'])->name('login');
		});
		Route::name('wpsp.')->group(function() {
			Route::get('wpsp\/(?P<endpoint>[^\/]+)\/?$', [wpsp::class, 'index'])->name('index');
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