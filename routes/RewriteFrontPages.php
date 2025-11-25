<?php

namespace WPSP\routes;

use WPSP\App\Components\RewriteFrontPages\auth;
use WPSP\App\Http\Middleware\StartSessionMiddleware;
use WPSP\App\Traits\InstancesTrait;
use WPSPCORE\Base\BaseRouter;
use WPSPCORE\Traits\RewriteFrontPagesRouteTrait;
use WPSP\App\Http\Middleware\EditorCapability;
use WPSP\App\Http\Middleware\AdministratorCapability;
use WPSP\App\Components\RewriteFrontPages\wpsp;
use WPSP\App\Components\RewriteFrontPages\wpsp_with_template;

class RewriteFrontPages extends BaseRouter {

	use InstancesTrait, RewriteFrontPagesRouteTrait;

	/*
	 *
	 */

	public function rewrite_front_pages() {
		$this->name('auth.')->prefix('auth')->group(function() {
			$this->get('login', [auth::class, 'login'])->middleware(StartSessionMiddleware::class)->name('login');
		});
		$this->name('wpsp.')->group(function() {
			$this->get('wpsp\/(?P<endpoint>[^\/]+)\/?$', [wpsp::class, 'index'])->middleware(StartSessionMiddleware::class)->name('index');
			$this->post('wpsp\/([^\/]+)\/?$', [wpsp::class, 'update']);
			$this->get('wpsp-with-template\/?$', [wpsp_with_template::class, 'index']);
		});
	}

	/*
	 *
	 */

	public function customProperties() {}

	/*
	 *
	 */

	public function actions() {}

	public function filters() {}

}